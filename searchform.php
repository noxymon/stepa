<h4>Blog Search</h4>
<form role="search" method="get" id="searchform" action="<?php echo home_url('/'); ?>">
    <div class="input-group">
        <input type="search" id="s" name="s" value="" class="form-control">
        <span class="input-group-btn">
            <button type="submit" value="<?php _e('Search', 'html5reset'); ?>" id="searchsubmit"class="btn btn-default">
                <span class="glyphicon glyphicon-search"></span>
            </button>
        </span>
    </div>
</form>