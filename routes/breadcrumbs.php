<?php

// Index page
\Breadcrumbs::register('index', function($breadcrumbs)
{
    $breadcrumbs->push('Главная', route('index'));
});

// Cart
\Breadcrumbs::register('cart', function($breadcrumbs)
{
    $breadcrumbs->parent('index');
    $breadcrumbs->push("Корзина", route('cart.index'));
});

// WishList
\Breadcrumbs::register('wishlist', function($breadcrumbs)
{
    $breadcrumbs->parent('index');
    $breadcrumbs->push("Список желаний", route('wishlist.index'));
});

// Single product
\Breadcrumbs::register('product-single', function($breadcrumbs,$product)
{
    $breadcrumbs->parent('index');
    $breadcrumbs->push($product->name, route('product.single',$product->name));
});

// Page
\Breadcrumbs::register('page', function($breadcrumbs,$page)
{
    $breadcrumbs->parent('index');
    $breadcrumbs->push($page->slug, route('pages.show',$page->path));
});


// Category
\Breadcrumbs::register('catalog', function($breadcrumbs,$category)
{

    $breadcrumbs->parent('index');

    foreach ($category->getAncestors() as $ancestor) {
        $breadcrumbs->push($ancestor->name, route('catalog.categories', $ancestor->path));
    }

    $breadcrumbs->push($category->name, route('catalog.categories', $category->path));
});
