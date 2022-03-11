<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Booking;
use App\Models\User;
use App\Models\Shop;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\BookingSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ShopSeeder;

class BookingControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->seed(ShopSeeder::class);
        $this->seed(BookingSeeder::class);
    }
    public function test_booking_index()
    {
        $this->actingAs($this->user, 'web');
        $response = $this->get('/api/booking');
        $response
        ->assertStatus(200)
        ->assertJsonStructure([
            'data'=>[
                '*' =>[
                    'user_id',
                    'shop_id',
                    'date',
                    'time',
                    'number_of_people',
                ]
            ]
        ]);
    }
    public function test_booking_store()
    {
        $tomorrow = date('Y-m-d', strtotime('2day'));
        $user = User::first();
        $shop = Shop::first();
        $data = [
            'user_id' => $user->id,
            'shop_id' => $shop->id,
            'date' => $tomorrow,
            'time' => '12:00',
            'number_of_people' => 10,
        ];
        $response = $this->post('/api/booking', $data);
        $response -> assertStatus(201);
        $response -> assertJsonFragment($data);
        $this->assertDatabaseHas('bookings', $data);
    }
    public function test_booking_show()
    {
        $this->actingAs($this->user, 'web');
        $booking = Booking::first();
        $response = $this->get('/api/booking/'. $booking->id);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'id' => $booking->id,
            'number_of_people' => 5,
        ]);
    }
    public function test_booking_update()
    {
        $this->actingAs($this->user, 'web');
        $booking = Booking::first();
        $data = [
            'user_id' => $booking->user_id,
            'shop_id' => $booking->shop_id,
            'date' => $booking->date,
            'time' => '20:00',
            'number_of_people' => 13,
        ];
        $response = $this->put('/api/booking/'. $booking->id, $data);
        $response->assertStatus(200);
        $this->assertDatabaseHas('bookings', $data);
    }
    public function test_booking_destroy()
    {
        $booking = Booking::first();
        $response = $this->delete('/api/booking/'.$booking->id);
        $response->assertStatus(200);
        $this->assertSoftDeleted($booking);
    }
}
