@foreach($data as $post)
    <p>Title : {{ $post->title }}</p>
    Tag :
    <?php
    $product = \App\Models\Blog::find($post->id);
    $tags = $product->tags;
    ?>
    @foreach($tags as $tag)
        <div class="chip">
            {{ $tag->name }}
        </div>
    @endforeach

    <br><br>
@endforeach