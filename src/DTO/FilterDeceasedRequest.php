<?php

namespace App\DTO;

use Symfony\Component\HttpFoundation\Request;

class FilterDeceasedRequest
{
    public function __construct(
        public readonly ?string $fullName = null,
        public readonly ?string $dateOfDeath = null,
        public readonly ?string $typeBurialLocation = null,
        public readonly ?int    $block = null,
        public readonly ?int    $section = null,
        public readonly ?string $created_at_start = null,
        public readonly ?string $created_at_end = null,
    )
    {
    }

    public static function fromRequest(Request $request) :self
    {
        $query = $request->query;
        return new self(
            fullName: $query->has('full_name') ? $query->get('full_name'): null,
            dateOfDeath: $query->has('date_of_death') ? $query->get('date_of_death'): null,
            typeBurialLocation: $query->has('type_burial_location') ? $query->get('type_burial_location'): null,
            block: $query->has('block') ? $query->get('block'): null,
            section: $query->has('section') ? $query->get('section'): null,
            created_at_start: $query->has('created_at_start') ? $query->get('created_at_start'): null,
            created_at_end: $query->has('created_at_end') ? $query->get('created_at_end'): null,
        );
    }

}
