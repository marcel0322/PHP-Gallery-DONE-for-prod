<?php

require_once '../db.php';
require '../models/file.php';

class fileHandling {

    public function watermark($file, $upload_dir, $watermark, $mime_type, $target, $water_target) {

        if (file_exists($water_target)) {
            echo "Watermarked file with this name already exists.\n";
            exit;
        }

        if($mime_type === "image/jpeg") {

            $water_jpeg = imagecreatefromjpeg("$target");
            $white = imagecolorallocate($water_jpeg, 255, 255, 255);
            $pos_x = (imagesx($water_jpeg) - 7.5 * strlen($watermark)) / 2;
            $pos_y = 30;
            imagestring($water_jpeg, 5, $pos_x, $pos_y, $watermark, $white);

            imagejpeg($water_jpeg, $water_target);
            imagedestroy($water_jpeg);

        } elseif ($mime_type === "image/png") {

            $water_png = imagecreatefrompng("$target");
            $white = imagecolorallocate($water_png, 255, 255, 255);
            $pos_x = (imagesx($water_png) - 7.5 * strlen($watermark)) / 2;
            $pos_y = 30;
            imagestring($water_png, 5, $pos_x, $pos_y, $watermark, $white);

            imagepng($water_png, $water_target);
            imagedestroy($water_png);

        } else echo "Failed to watermark image.\n";
    }

    public function thumbnail($file, $upload_dir, $mime_type, $target, $water_target) {
        $thumb_target = $upload_dir . "thumbnails/" . basename($file["name"]);

        if (file_exists($thumb_target)) {
            echo "Thumbnail of this file with this name already exists.\n";
            exit;
        }

        if($mime_type === "image/jpeg") {

         $thumb_jpeg = imagecreatefromjpeg("$water_target");
            $thumbed_jpeg = imagescale($thumb_jpeg, 200, 125);
            imagejpeg($thumbed_jpeg, $thumb_target);
            imagedestroy($thumb_jpeg);
            imagedestroy($thumbed_jpeg);
            echo "File uploaded successfully.\n";

        } elseif ($mime_type === "image/png") {

            $thumb_png = imagecreatefrompng("$water_target");
            $thumbed_png = imagescale($thumb_png, 200, 125);
            imagepng($thumbed_png, $thumb_target);
            imagedestroy($thumb_png);
            imagedestroy($thumbed_png);
            echo "File uploaded successfully.\n";

        } else echo "Failed to make thumbnail.\n";
    }

    public function upload() {
        $error = false;
        $file = $_FILES["image"];
        $upload_dir = "/var/www/prod/src/web/images/";
        $target = $upload_dir . basename($file["name"]);
        $watermark = $_POST["watermark"];
        $water_target = $upload_dir . "watermarked_images/" . basename($file["name"]);

        $file_info = finfo_open(FILEINFO_MIME_TYPE);
        $file_name = $file["tmp_name"];

        if($file["error"]){
            echo "Cannot process your file.\n";
            exit;
        }

        $mime_type = finfo_file($file_info, $file_name);

        if (file_exists($target)) {
            echo "File with this name already exists.\n";
            $error = true;
        }

        if($file["size"] > 1000000) {
            echo "File size is too big.\n";
            $error = true;
        } //else echo "File size is ok.\n";

        if($mime_type != "image/jpeg" && $mime_type != "image/png") {
            echo "File format is not supported. Only JPEG and PNG formats are supported.\n";
            $error = true;
        } //else echo "File format is ok.\n";

        if($error) {
            echo "Your file was not uploaded.\n";
        } else {
            if(move_uploaded_file($file_name, $target)) {
                $title = $_POST['title'];
                $author = $_POST['author'];
                $filename = basename($file['name']);
                $uploaded_file = new file($title, $author, $filename);
                $uploaded_file -> save();
                fileHandling::watermark($file, $upload_dir, $watermark, $mime_type, $target, $water_target);
                fileHandling::thumbnail($file, $upload_dir, $mime_type, $target, $water_target);
            } else echo "Your file was not uploaded.\n";
        }
    }

    public function save() {
        $response = db::get_db()->images->insertOne([
            'title' => $this->title,
            'author'=>$this->author,
            'filename' =>$this->filename,
        ]);
        $this->id = $response->getInsertedId();
    }

    public static function get_all() {
        $response = db::get_db()->images->find();
        $images = [];
        foreach ($response as $file){
            $images[] = new file($file['title'], $file['author'], $file['filename']);
        }
        return $images;
    }
}