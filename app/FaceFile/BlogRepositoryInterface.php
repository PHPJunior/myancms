<?php
/**
 * Created by PhpStorm.
 * User: Nyi Nyi Lwin
 * Date: 5/16/2016
 * Time: 3:52 PM
 */

namespace App\FaceFile;


use Illuminate\Support\Facades\Request;

interface BlogRepositoryInterface
{
    /**
     * @param $id
     * @return mixed
     */
    public function get($id);

    /**
     * @param null $paginate
     * @return mixed
     */
    public function getLatestBlogs($paginate = null);


    public function getAllBlogs();

}