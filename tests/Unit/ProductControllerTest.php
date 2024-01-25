<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Category;
use App\Models\Product;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */

    public function testAddProduct()
    {
        $category = Category::factory()->create();
        $newProduct = [
            'name' => 'New Product',
            'price' => 102.5,
            'quantity' => 10,
            'category_id' => $category->id
        ];

        $response = $this->post('/api/products', $newProduct);

        $response->assertStatus(200);
        $product = Product::first();
        $response->assertJson([
            'success' => true,
            'data' => $product->toArray(),
            'message' => 'The Product is Created Successfully'
        ]); // axpected response
        $this->assertDatabaseHas('products', $product->toArray()); // Assert that the product was added to the database
    }
}
