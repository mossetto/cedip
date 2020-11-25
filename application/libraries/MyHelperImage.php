<?php 

class MyHelperImage
{
	public function redimensionar_imagen($width,$height,$src,$dir_file){
        $w = $width;
        $h = $height;
        $mode = 'fit';
        $src = imagecreatefromjpeg($src);
        $dst = imagecreatetruecolor($w, $h);
        imagefill($dst, 0, 0, imagecolorallocate($dst, 255, 255, 255));
        $this->scale_image($src, $dst, $mode);
        $guardo= imagejpeg($dst,$dir_file);
        return $guardo;
    }
    
    public function obtenerExtensionFichero($str){
        $extension=explode(".", $str);
        $extension_selected=end($extension);
        return $extension_selected;
    }
    
    private function scale_image($src_image, $dst_image, $op = 'fit') {
	    $src_width = imagesx($src_image);
	    $src_height = imagesy($src_image);
	 
	    $dst_width = imagesx($dst_image);
	    $dst_height = imagesy($dst_image);
	
	    $new_width = $dst_width;
	    $new_height = round($new_width*($src_height/$src_width));
	    $new_x = 0;
	    $new_y = round(($dst_height-$new_height)/2);
	 
	    if ($op =='fill')
	        $next = $new_height < $dst_height;
	     else
	        $next = $new_height > $dst_height;
	 
	    if ($next) {
	        $new_height = $dst_height;
	        $new_width = round($new_height*($src_width/$src_height));
	        $new_x = round(($dst_width - $new_width)/2);
	        $new_y = 0;
	    }

	    imagecopyresampled($dst_image, $src_image , $new_x, $new_y, 0, 0, $new_width, $new_height, $src_width, $src_height);
	}
}