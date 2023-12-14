<?php
namespace App\Services\Interface;

interface PostServiceInterface
{
    public function getAll();
    public function getByCategory(string $categorySlug);
    public function searchTitle(string $title);
    public function searchContent(string $content);
}