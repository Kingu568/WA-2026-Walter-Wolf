<?php

class BookDTO
{
    public $title;
    public $author;
    public $isbn;
    public $category;
    public $subcategory;    
    public $year;
    public $price;
    public $link;
    public $description;
    public $images;

    public function __construct($data)
    {
        $this->title = trim($data['title'] ?? '');
        $this->author = trim($data['author'] ?? '');
        $this->isbn = trim($data['isbn'] ?? '');
        $this->category = trim($data['category'] ?? '');
        $this->subcategory = trim($data['subcategory'] ?? '');
        $this->year = $data['year'] ?? 0;
        $this->price = $data['price'] ?? null;
        $this->link = trim($data['link'] ?? '');
        $this->description = trim($data['description'] ?? '');
        $this->images = $data['images'] ?? [];
    }
}