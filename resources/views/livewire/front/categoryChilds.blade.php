@foreach ($childs as $child)
    <?php
    $new = [
        'childs' => $child->childs,
        'padding' => $padding + 20,
    ];
    if(app()->getLocale()=='en')
    {$pad='padding-left:'.$padding;}else{$pad='padding-right:'.$padding;}
    ?>
        <li class="list__item" id="{{$child->id}}" onclick="javascript:search_result(this.id,'Category')" style="<?php echo $pad; ?>px">
            <a class="list__item__link" >{{$child->name}}</a>
            <span>({{count($child->blogs)}})</span>
        </li>
    @if (count($child->childs))
        @include('livewire.front.categoryChilds', $new)
    @endif
@endforeach