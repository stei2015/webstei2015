<?php

function filter_filename($fileName){
    return preg_replace('/[^(a-zA-Z0-9_\(\)\[\]\-.,)]/','',$fileName);
}

function upload_file($fileid, $destination_dir, $maxsize = 32000000){
	try {
	   
	    // Undefined | Multiple Files | $_FILES Corruption Attack
	    // If this request falls under any of them, treat it invalid.
	    if (
	        !isset($_FILES[$fileid]['error']) ||
	        is_array($_FILES[$fileid]['error'])
	    ) {
	        throw new RuntimeException('Parameter tidak valid.');
	    }

	    // Check $_FILES[$fileid]['error'] value.
	    switch ($_FILES[$fileid]['error']){
	        case UPLOAD_ERR_OK:
	            break;
	        case UPLOAD_ERR_NO_FILE:
	            throw new RuntimeException('Tidak ada file yang diupload.');
	        case UPLOAD_ERR_INI_SIZE:
	        case UPLOAD_ERR_FORM_SIZE:
	            throw new RuntimeException('File terlalu besar.');
	        default:
	            throw new RuntimeException('Error mengupload file.');
	    }

	    if($_FILES[$fileid]['size'] > $maxsize){
	        throw new RuntimeException('File terlalu besar.');
	    }

	    $fileName = filter_var($_FILES[$fileid]['name'],FILTER_SANITIZE_STRING);
	    $fileName = filter_filename($fileName);

	    if(file_exists($destination_dir.'/'.$fileName)){
		   	throw new RuntimeException('Sudah ada file dengan nama yang sama.');
		}
	    
	    if(!move_uploaded_file($_FILES[$fileid]['tmp_name'], $destination_dir.'/'.$fileName)){
	        throw new RuntimeException('Gagal memindahkan file yang sudah diupload.');
	    }

	   return $fileName;

	} catch (RuntimeException $e){
		$GLOBALS['upload_file_error'] = $e->getMessage();
		return '';
	}
}

function upload_pp($fileid, $targetname, $maxsize = 1024000){
	try {
	   
	    // Undefined | Multiple Files | $_FILES Corruption Attack
	    // If this request falls under any of them, treat it invalid.
	    if (
	        !isset($_FILES[$fileid]['error']) ||
	        is_array($_FILES[$fileid]['error'])
	    ) {
	        throw new RuntimeException('Parameter tidak valid.');
	    }

	    // Check $_FILES[$fileid]['error'] value.
	    switch ($_FILES[$fileid]['error']){
	        case UPLOAD_ERR_OK:
	            break;
	        case UPLOAD_ERR_NO_FILE:
	            throw new RuntimeException('Tidak ada file yang diupload.');
	        case UPLOAD_ERR_INI_SIZE:
	        case UPLOAD_ERR_FORM_SIZE:
	            throw new RuntimeException('File terlalu besar.');
	        default:
	            throw new RuntimeException('Gagal mengupload file.');
	    }

	    if($_FILES[$fileid]['size'] > $maxsize){
	        throw new RuntimeException('File terlalu besar.');
	    }

	    $fileType = exif_imagetype($_FILES[$fileid]['tmp_name']);
	   	if(($fileType != IMAGETYPE_PNG) && ($fileType != IMAGETYPE_JPEG) && ($fileType != IMAGETYPE_GIF) && ($fileType != IMAGETYPE_BMP)){
	   		throw new RuntimeException('File harus merupakan gambar yang valid.');
	   	}

	    $fileName = filter_filename($targetname);
	    $destination_dir = __DIR__.'/../data/profilepictures';

	    if(file_exists($destination_dir.'/'.$fileName)){
		   	unlink($destination_dir.'/'.$fileName);
		}
	    
	    if(!move_uploaded_file($_FILES[$fileid]['tmp_name'], $destination_dir.'/'.$fileName)){
	        throw new RuntimeException('Gagal memindahkan file yang sudah diupload.');
	    }

	   	return '';

	} catch (RuntimeException $e){
		return $e->getMessage();
	}
}

?>