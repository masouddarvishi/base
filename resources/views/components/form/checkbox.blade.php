<div class="mdc-form-field">

<div class="mdc-checkbox">
    <input type="checkbox" class="mdc-checkbox__native-control" id="{{$name}}" name="{{$name}}" value="{{$value ?? ''}}" @if(isset($checked)&&$checked) checked @endif />
    <div class="mdc-checkbox__background">
    <svg class="mdc-checkbox__checkmark"
            viewBox="0 0 24 24">
        <path class="mdc-checkbox__checkmark-path"
            fill="none"
            d="M1.73,12.91 8.1,19.28 22.79,4.59"/>
    </svg>
    <div class="mdc-checkbox__mixedmark"></div>
    </div>
</div>
<label for="{{$name}}">{{$label ?? ''}}</label>
</div>