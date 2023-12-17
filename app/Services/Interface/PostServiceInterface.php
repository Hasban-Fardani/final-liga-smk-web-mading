<?php
namespace App\Services\Interface;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

/**
 * Interface for the PostService.
 */
interface PostServiceInterface
{
    /**
     * Retrieve all records from the database.
     *
     * @return array The array of records.
     */
    public function getAll();
    /**
     * Retrieves all published items
     *
     * @return array The list of published items
     */
    public function getAllPublished();
    
    /**
     * Get posts by creator.
     *
     * @param string $creatorUsername
     * @return array
     */
    public function getByCreator(string $creatorUsername, bool $published = false);

    /**
     * Retrieves items by category slug.
     *
     * @param string $categorySlug The slug of the category.
     * @return void
     */
    public function getByCategory(string $categorySlug);
    
    /**
     * Search posts.
     *
     * @param string $query
     * @return array
     */
    public function search(string $query);

    /**
     * Create a new post.
     *
     * @param StorePostRequest $request
     * @return void
     */
    public function create(StorePostRequest $request);

    /**
     * Update a post.
     *
     * @param UpdatePostRequest $request
     * @param Post $post
     * @return void
     */
    public function update(Request $request, Post $post);

    /**
     * Delete a post.
     *
     * @param Post $post
     * @return void
     */
    public function delete(Post $post);
}