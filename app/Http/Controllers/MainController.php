<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index($number_page = 1)
    {

        $count_page=ceil (Book::all()->count()/10);

$books=Book::offset($number_page*10-10)->limit(10)->get();




        return view('welcome', array(
            'books' => $books,
            'number_page'=>$number_page,
            'count_page'=>$count_page,
        ));
    }
    public function save(Request $request)
    {


            $q=0;
            if(Book::all()->count()%10===0){
                $q=17;
            }
            $books = new Book();
            $books->name = $request['name'];
            $books->description = $request['description'];
            $books->author = $request['author'];
            $books->count_page = $request['count_page'];
            $books->name_img = $request->session()->get('name_img');
            $books->save();
        $request->session()->put('name_img','null');
            if ($books->save()) {
                if($q===17){
                    return 'new_page';
                }
                return $books;
            }

    }
    public function priem(Request $request)
    {


        $final_width_of_image = 100;
        $path_to_image_directory = 'images/max/';
        $path_to_thumbs_directory = 'images/min/';


        function createThumbnail($filename)
        {
            $final_width_of_image = 100;
            $path_to_image_directory = 'images/max/';
            $path_to_thumbs_directory = 'images/min/';


            if (preg_match('/[.](jpg)$/', $filename)) {
                $im = imagecreatefromjpeg($path_to_image_directory . $filename);
            } else if (preg_match('/[.](gif)$/', $filename)) {
                $im = imagecreatefromgif($path_to_image_directory . $filename);
            } else if (preg_match('/[.](png)$/', $filename)) {
                $im = imagecreatefrompng($path_to_image_directory . $filename);
            }

            $ox = imagesx($im);
            $oy = imagesy($im);

            $nx = $final_width_of_image;
            $ny = floor($oy * ($final_width_of_image / $ox));

            $nm = imagecreatetruecolor($nx, $ny);

            imagecopyresized($nm, $im, 0, 0, 0, 0, $nx, $ny, $ox, $oy);

            if (!file_exists($path_to_thumbs_directory)) {
                if (!mkdir($path_to_thumbs_directory)) {
                    die("Возникли проблемы! попробуйте снова!");
                }
            }
            imagejpeg($nm, $path_to_thumbs_directory . $filename);
            $tn = '<img src="' . $path_to_thumbs_directory . $filename . '" alt="image" />';
            $tn .= '<br />Поздравляем! Ваше изображение успешно загружено и его миниатюра удачно выполнена. Выше Вы можете просмотреть результат:';

        }
        if (isset($_FILES['file'])) {

            if (preg_match('/[.](jpg)|(gif)|(png)$/', //Ставим допустимые форматы изображений для загрузки
                $_FILES['file']['name'])) {
                $type = explode('.', $_FILES['file']['name']);
                $type = $type[count($type) - 1];

                $b = md5_file($_FILES['file']['tmp_name']) . '.' . $type;
                $filename = md5_file($_FILES['file']['tmp_name']) . '.' . $type;
                $source = $_FILES['file']['tmp_name'];
                $target = $path_to_image_directory . $filename;

                move_uploaded_file($source, $target);

                createThumbnail($filename);
            }
        }
        $request->session()->put('name_img',$b);
return 'зображення завантажено на сервер';






//

    }


}
