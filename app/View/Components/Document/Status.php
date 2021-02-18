<?php

namespace App\View\Components\Document;

use App\Models\Document;
use Illuminate\View\Component;

class Status extends Component
{
    /**
     * @var Document
     */
    private Document $document;

    /**
     * Create a new component instance.
     *
     * @param Document $document
     */
    public function __construct(Document $document)
    {
        $this->document = $document;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.document.status', [
            'document' => $this->document,
        ]);
    }
}
