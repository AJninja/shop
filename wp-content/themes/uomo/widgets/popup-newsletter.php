<div class="popupnewsletter hidden">
  <!-- Modal -->
  <button title="<?php echo esc_html('Close (Esc)', 'uomo'); ?>" type="button" class="mfp-close apus-mfp-close"> <span class="ti-close"></span> </button>
  <div class="modal-content">
      <div class="popupnewsletter-widget <?php echo (isset($image) && $image)?'has-image':''; ?>">
        <?php if ( isset($image) && $image ) : ?>
          <div class="image">
            <img src="<?php echo esc_attr( $image ); ?>" alt="<?php esc_attr_e( 'image', 'uomo' ); ?>">
          </div>
        <?php endif; ?>
        <div class="info">
          <?php if(!empty($title)){ ?>
              <h3 class="title">
                  <?php echo esc_html( $title ); ?>
              </h3>
          <?php } ?>
          
          <?php if(!empty($description)){ ?>
              <div class="description">
                  <?php echo trim( $description ); ?>
              </div>
          <?php } ?>    
          <div class="widget-mailchimp">
            <?php
            if ( function_exists('mc4wp_show_form') ) {
              mc4wp_show_form('');
            }
            ?>
          </div>
          <div class="close-dont-show">
            <a href="javascript:void(0)"><?php esc_html_e('Don\'t show this popup again', 'uomo'); ?></a>
          </div>
        </div>
    </div>
  </div>
</div>