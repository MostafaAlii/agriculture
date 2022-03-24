
@foreach($childs as $child)
        <?php
        if(isset($parent_id) && $parent_id == $child->id){$select_or_no='selected';}else{ $select_or_no='';}
        
         $extra='';
         for($i=1;$i<=$number;$i++){
            $extra.='-';
         }

         if(isset($parent_id)){$parent_id=$parent_id;}else{$parent_id=0;}
        if(isset($depart_id)){$depart_id=$depart_id;}else{$depart_id=0;}
        
        //  $color = array("#4d28de", "#9d1d81", "#7a5114","#0c6a78");
        $colors=array("#4d28de","rgb(0 152 121)","#9d561c","rgb(128 47 143)","rgb(180 191 17)","rgb(207 29 86)","rgb(78 203 209)");
        $new= [
            'childs' => $child->childs,
            'color'=>$colors[$number],
            // 'color' =>$color[$number],
            'number'=>$number+1,
            
            // 'depart_id'=>$depart_id,
            // 'parent_id'=>$child->parent_id

            'depart_id'=>$depart_id,//pramiry key of department we edit on it 
            'parent_id'=>$parent_id //parent_id of another department
        ];
        // <!-- @if($child->id!=$parent_id) -->

?>
       @if($child->id!=$depart_id)
            <option style="color: {{$color}};" value="{{ $child->id }}" <?php echo $select_or_no;?>> <?php echo $extra;?> {{ $child->name }}</option>
            @if(count($child->childs))
                @include('dashboard.admin.departments.mangeChild',$new)
            @endif

        @endif
@endforeach