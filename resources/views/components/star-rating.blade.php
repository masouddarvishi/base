
<div class="star-rating" style="">
    <div class="star-rating-empty grey-text">
        <div class="star-rating">
            <i class="material-icons">star</i><i class="material-icons">star</i><i class="material-icons">star</i><i class="material-icons">star</i><i class="material-icons">star</i>
        </div>
    </div>
    <div class="star-rating-fill" style="width:{{20 * $rating}}%;">
        <div class="star-rating">
            <i class="material-icons">star</i><i class="material-icons">star</i><i class="material-icons">star</i><i class="material-icons">star</i><i class="material-icons">star</i>
        </div>
    </div>
</div>
<style>
    .star-rating .material-icons{font-size: 30px;}
    .star-rating{
        position: relative;
        height: 30px;
        width: 150px;
    }
    .star-rating-empty i{
        color:#d5d5d5;
    }
    .star-rating-fill{
        overflow: hidden;
        position: absolute;
        top:0;
        right: 0;
    }
    .star-rating-fill i{
        color :#f4c150;
    }
</style>

