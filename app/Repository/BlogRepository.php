<?php
/**
 * Created by PhpStorm.
 * User: Nyi Nyi Lwin
 * Date: 5/16/2016
 * Time: 3:57 PM
 */

namespace App\Repository;

use App\FaceFile\BlogRepositoryInterface;
use App\Models\Blog;

class BlogRepository implements BlogRepositoryInterface
{

    /**
     * @param Blog $blogs
     */
    public function __construct(Blog $blog)
    {
        $this->blog = $blog;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function get($id)
    {
        return $this->blog->where('id', '=', $id)->with('user')->first();
    }

    /**
     * Get All Blogs
     */
    public function getAllBlogs()
    {
        return $this->blog->with('user')->get();
    }

    /**
     * @param null $paginate
     * @return mixed
     */
    public function getLatestBlogs($paginate = null)
    {
        // TODO: Implement getLatestBlogs() method.
    }

}