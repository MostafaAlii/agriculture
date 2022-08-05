 <!-- ----------------------------------------------------------------------- -->
 <div class="form-group col-md-4">
    <label for="eventRegInput4">{{ __('Admin/departments.depart_country') }}<span class="text-danger">*</span></label>
        <select class="custom-select" id="country_id" name="country_id" required >
            <!-- <option value="" disabled>اختر البلد</option> -->
                @foreach($country as $country)
                    <option value="{{$country->id}}" <?php if(isset($depart->country_id) && ($country->id==$depart->country_id)){echo'selected';}elseif(old('country_id') == $country->id){echo "selected";}?>>{{$country->name}}</option>
                @endforeach
            </select>
            @error('country_id')
            <small class="form-text text-danger">{{$message}}</small>
        @enderror
</div>
<div class="form-group col-md-2">
    <label>{{ __('Admin/site.province') }}<span class="text-danger">*</span></label>
    <select class="form-control" id="province_id" name="province_id" required>
            <!-- <option value="" disabled>{{ __('Admin/site.select') }}</option> -->
                @foreach($province as $pro)
                    <option value="{{$pro->id}}" <?php if(isset($depart->province_id) && ($pro->id==$depart->province_id)){echo'selected';}elseif(old('province_id') == $pro->id){echo "selected";}?>>{{$pro->name}}</option>
                @endforeach
    </select>
    @error('province_id')
        <small class="form-text text-danger">{{$message}}</small>
    @enderror
</div>
<div class="form-group col-md-2">
    <label>{{ __('Admin/site.area') }}<span class="text-danger">*</span></label>
    <select class="form-control" id="area_id" name="area_id" required>
        <!-- <option value="" disabled>{{ __('Admin/site.select') }}</option> -->
                @foreach($area as $ar)
                    <option value="{{$ar->id}}" <?php if(isset($depart->area_id) && ($ar->id==$depart->area_id)){echo'selected';}elseif(old('area_id') == $ar->id){echo "selected";}?>>{{$ar->name}}</option>
                @endforeach
    </select>
    @error('area_id')
        <small class="form-text text-danger">{{$message}}</small>
    @enderror
</div>
<div class="form-group col-md-2">
    <label>{{ __('Admin/site.state') }}</label>
    <select class="form-control" id="state_id" name="state_id">
        <option value="" disabled <?php if(isset($depart->state_id) && ($depart->state_id == Null)){echo'selected';}elseif(old('state_id') == ''){echo "selected";}?>>{{ __('Admin/site.select') }}</option>
            @foreach($state as $s)
                    <option value="{{$s->id}}"  <?php if(isset($depart->state_id) && ($s->id==$depart->state_id)){echo'selected';}elseif(old('state_id') == $s->id){echo "selected";}?>>{{$s->name}}</option>
                @endforeach
        </select>
    @error('state_id')
        <small class="form-text text-danger">{{$message}}</small>
    @enderror
</div>
<div class="form-group col-md-2">
    <label>{{ __('Admin/site.village') }}</label>
    <select class="form-control" id="village_id" name="village_id">
        <option value="" disabled <?php if(isset($depart->village_id) && ($depart->village_id == Null )){echo'selected';}elseif(old('village_id') == ''){echo "selected";}?>>{{ __('Admin/site.select') }}</option>
                @foreach($village as $vill)
                    <option value="{{$vill->id}}" <?php if(isset($depart->village_id) && ($vill->id==$depart->village_id)){echo'selected';}elseif(old('village_id') == $vill->id){echo "selected";}?>>{{$vill->name}}</option>
                @endforeach
    </select>
    @error('village_id')
        <small class="form-text text-danger">{{$message}}</small>
    @enderror
</div>