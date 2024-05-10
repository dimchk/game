<?php

namespace Tests\Feature;

use App\Enums\GameResultState;
use App\Models\GameResult;
use App\Models\User;
use App\Services\GameService;
use App\Strategy\DefaultGameStrategy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DefaultGameStrategyTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->gameService = $this->app->make(GameService::class);
        $this->defaultGameStrategy = $this->app->make(DefaultGameStrategy::class);
    }


    public function test_default_game_result_is_correct(): void
    {
        $user = User::factory()->create();
        $n = 10000;
        for ($i = 0; $i < $n; $i++) {
            /**
             * @var $gameResult GameResult
             */
            $gameResult = $this->gameService->play($user->id, $this->defaultGameStrategy);
            $this->assertIsObject($gameResult);
            $this->assertTrue($gameResult->result <= 1000);
            $this->assertTrue($gameResult->result >= 1);

            if ($gameResult->result % 2 == 0) {
                $this->assertEquals(
                    $gameResult->result_state,
                    GameResultState::WIN
                );
                if ($gameResult->result > 900) {
                    $this->assertEquals($gameResult->prize, $gameResult->result * 0.7);
                } else {
                    if ($gameResult->result > 600) {
                        $this->assertEquals($gameResult->prize, $gameResult->result * 0.5);
                    } else {
                        if ($gameResult->result > 300) {
                            $this->assertEquals($gameResult->prize, $gameResult->result * 0.3);
                        } else {
                            $this->assertEquals($gameResult->prize, $gameResult->result * 0.1);
                        }
                    }
                }
            } else {
                $this->assertEquals(
                    $gameResult->result_state,
                    GameResultState::LOSE
                );
                $this->assertEquals($gameResult->prize, 0);
            }
        }
    }
}
