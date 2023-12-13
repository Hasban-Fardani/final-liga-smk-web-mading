<!-- Nothing in life is to be feared, it is only to be understood. Now is the time to understand more, so that we may fear less. - Marie Curie -->
<div>
    <p>title: 

        {{ $post->title }}
    </p>
    <p>
        body:   
        {{ $post->body }}
    </p>
    {{ $post->creator->username }}
    <p>{{ $post->created_at->diffForHumans() }}</p>
</div>
