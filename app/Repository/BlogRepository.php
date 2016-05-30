<?php
/**
 * Created by PhpStorm.
 * User: Nyi Nyi Lwin
 * Date: 5/16/2016
 * Time: 3:57 PM
 */

namespace App\Repository;

use App\Models\Blog;

/**
 * Class BlogRepository
 * @package App\Repository
 */
class BlogRepository
{
    protected $blog;

    /**
     * @param Blog $blog
     * @internal param Blog $blogs
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