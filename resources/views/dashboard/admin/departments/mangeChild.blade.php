
@foreach($childs as $child)
        <?php
        if(isset($parent_id) && $parent_id == $child->id){$select_or_no='selected';}else{ $select_or_no='';}
        
         $extra='';
         for($i=1;$i<=$number;$i++){
            $extra.='-';
         }

        //  $color = array("#4d28de", "#9d1d81", "#7a5114","#0c6a78");
         
        $new= [
            'childs' => $child->childs,
            'color'=>'#4d28de',
            // 'color' =>$color[$number],
            'number'=>$number+1,
            
            // 'depart_id'=>$depart_id,
            // 'parent_id'=>$child->parent_id

            'depart_id'=>$child->id,//pramiry key of department we edit on it 
            'parent_id'=>$parent_id //parent_id of another department
        ];
        // <!-- @if($child->id!=$depart_id) -->

?>
       @if($child->id!=$depart_id)
            <option style="color: {{$color}};" value="{{ $child->id }}" <?php echo $select_or_no;?>> <?php echo $extra;?> {{ $child->name }}</option>
            @if(count($child->childs))
                @include('dashboard.admin.departments.mangeChild',$new)
            @endif

        @endif
@endforeach