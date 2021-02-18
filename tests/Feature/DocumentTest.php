<?php

namespace Tests\Feature;

use App\Contracts\DocumentStatusContract;
use App\Models\Document;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DocumentTest extends TestCase
{
    use DatabaseMigrations;
    use WithFaker;

    /** @test **/
    public function client_can_create_document(): void
    {
        $this->postJson(route('v1.documents.store'))
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'status',
                    'payload',
                    'created_at',
                    'updated_at',
                ]
            ])
            ->assertJsonFragment([
                'status' => DocumentStatusContract::DRAFT
            ]);
    }
    
    /** @test **/
    public function client_can_update_drafted_document(): void
    {
        $document = Document::factory()->create();

        $data = [
            'payload' => [
                'actor' => $actor = $this->faker->name,
                'meta' => $meta = [
                    'type' => $this->faker->word,
                    'color' => $this->faker->colorName,
                ],
                'actions' => $actions = [
                    [
                        'action' => $this->faker->sentence,
                        'actor' => $this->faker->name,
                    ]
                ]
            ],
        ];

        $this->patchJson(route('v1.documents.update', compact('document')), $data)
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'status',
                    'payload' => [
                        'actor',
                        'meta' => [
                            'type',
                            'color',
                        ],
                        'actions' => [
                            [
                                'action',
                                'actor',
                            ]
                        ]
                    ]
                ]
            ])
            ->assertJsonFragment([
                'actor' => $actor,
                'meta' => $meta,
                'actions' => $actions,
            ]);
    }

    /** @test **/
    public function client_can_publish_document(): void
    {
        $document = Document::factory()->create();

        $this->postJson(route('v1.document.publish', compact('document')))
            ->assertSuccessful();

        self::assertSame(DocumentStatusContract::PUBLISHED, $document->fresh()->status);
    }

    /** @test **/
    public function client_can_see_list_of_documents(): void
    {
        $this->getJson(route('v1.documents.index'))
            ->assertSuccessful()
            ->assertJsonStructure([
                'data',
                'links',
                'meta' => [
                    'current_page',
                    'per_page',
                    'total',
                ],
            ]);
    }
}
