@foreach ($childs as $child)
    <?php
    $new = [
        'childs' => $child->childs,
        'padding' => $padding + 20,
    ];
    if(app()->getLocale()=='en')
    {$pad='padding-left:'.$padding;}else{$pad='padding-right:'.$padding;}
    ?>
        <li class="list__item" id="{{$child->id}}" style="<?php echo $pad; ?>px">
            <a class="list__item__link" href="#">{{$child->name}}</a>
            <span>(2)</span>
        </li>
    @if (count($child->childs))
        @include('livewire.front.categoryChilds', $new)
    @endif
@endforeach