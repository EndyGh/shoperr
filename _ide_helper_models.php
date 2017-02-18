<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Brand
 *
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $products
 * @method static \Illuminate\Database\Query\Builder|\App\Brand whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Brand whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Brand whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Brand whereUpdatedAt($value)
 */
	class Brand extends \Eloquent {}
}

namespace App{
/**
 * App\Cart
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property string $row_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Cart whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cart whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cart whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cart whereRowId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cart whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cart whereUserId($value)
 */
	class Cart extends \Eloquent {}
}

namespace App{
/**
 * App\Category
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $path
 * @property string $slug
 * @property bool $active
 * @property int $image_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $_lft
 * @property int $_rgt
 * @property int $parent_id
 * @property-read \Kalnoy\Nestedset\Collection|\App\Category[] $children
 * @property-read \App\Category $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $products
 * @method static \Illuminate\Database\Query\Builder|\App\Category d()
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereImageId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereLft($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category wherePath($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereRgt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereUpdatedAt($value)
 */
	class Category extends \Eloquent {}
}

namespace App{
/**
 * App\Image
 *
 * @property int $id
 * @property string $url
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $products
 * @method static \Illuminate\Database\Query\Builder|\App\Image whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Image whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Image whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Image whereUrl($value)
 */
	class Image extends \Eloquent {}
}

namespace App{
/**
 * App\Order
 *
 * @property int $id
 * @property int $user_id
 * @property float $total
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\OrderDetail $detail
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\OrderItem[] $orderItems
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereTotal($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order whereUserId($value)
 */
	class Order extends \Eloquent {}
}

namespace App{
/**
 * App\OrderDetail
 *
 * @property int $id
 * @property int $order_id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $city
 * @property string $phone
 * @property string $shipping-address
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\OrderDetail whereCity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderDetail whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderDetail whereFirstName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderDetail whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderDetail whereLastName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderDetail whereOrderId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderDetail wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderDetail whereShippingAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderDetail whereUpdatedAt($value)
 */
	class OrderDetail extends \Eloquent {}
}

namespace App{
/**
 * App\OrderItem
 *
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Product $product
 * @method static \Illuminate\Database\Query\Builder|\App\OrderItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderItem whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderItem whereOrderId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderItem whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\OrderItem whereUpdatedAt($value)
 */
	class OrderItem extends \Eloquent {}
}

namespace App{
/**
 * App\Page
 *
 * @property int $id
 * @property string $path
 * @property string $slug
 * @property string $description
 * @property bool $active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Page whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Page whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Page whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Page wherePath($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Page whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Page whereUpdatedAt($value)
 */
	class Page extends \Eloquent {}
}

namespace App{
/**
 * App\Product
 *
 * @property int $id
 * @property string $name
 * @property string $title
 * @property string $code
 * @property string $guarantee
 * @property string $description
 * @property float $price_usd
 * @property float $price_uah
 * @property int $amount
 * @property bool $active
 * @property int $brand_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Brand $brands
 * @property-read \Kalnoy\Nestedset\Collection|\App\Category[] $categories
 * @property mixed $tag_names
 * @property-read Illuminate\Database\Eloquent\Collection $tags
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Image[] $images
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Property[] $properties
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Review[] $reviews
 * @property-read \Illuminate\Database\Eloquent\Collection|\Conner\Tagging\Model\Tagged[] $tagged
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereBrandId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereGuarantee($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product wherePriceUah($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product wherePriceUsd($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product withAllTags($tagNames)
 * @method static \Illuminate\Database\Query\Builder|\App\Product withAnyTag($tagNames)
 */
	class Product extends \Eloquent {}
}

namespace App{
/**
 * App\Property
 *
 * @property int $id
 * @property string $name
 * @property string $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $products
 * @method static \Illuminate\Database\Query\Builder|\App\Property whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Property whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Property whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Property whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Property whereValue($value)
 */
	class Property extends \Eloquent {}
}

namespace App{
/**
 * App\Review
 *
 * @property mixed created_at
 * @property int $id
 * @property int $product_id
 * @property int $user_id
 * @property int $rating
 * @property string $comment
 * @property bool $approved
 * @property bool $spam
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read mixed $timeago
 * @property-read \App\Product $product
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Review approved()
 * @method static \Illuminate\Database\Query\Builder|\App\Review notSpam()
 * @method static \Illuminate\Database\Query\Builder|\App\Review spam()
 * @method static \Illuminate\Database\Query\Builder|\App\Review whereApproved($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Review whereComment($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Review whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Review whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Review whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Review whereRating($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Review whereSpam($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Review whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Review whereUserId($value)
 */
	class Review extends \Eloquent {}
}

namespace App{
/**
 * App\Slide
 *
 * @property int $id
 * @property string $text
 * @property int $slider_id
 * @property string $image
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Slide whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Slide whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Slide whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Slide whereSliderId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Slide whereText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Slide whereUpdatedAt($value)
 */
	class Slide extends \Eloquent {}
}

namespace App{
/**
 * App\Slider
 *
 * @property int $id
 * @property bool $active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Slide[] $slides
 * @method static \Illuminate\Database\Query\Builder|\App\Slider whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Slider whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Slider whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Slider whereUpdatedAt($value)
 */
	class Slider extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

