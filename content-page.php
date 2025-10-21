<?php the_content(); ?>

	
<?php if (have_rows('popup_1')): ?>
    <?php while (have_rows('popup_1')): the_row();
      // Get sub field values.
      global    $content_popup_1;
      $button = get_sub_field('button');
      $content_popup_1 = get_sub_field('content');
      $string = trim(preg_replace('/\s+/', ' ', $content_popup_1));
      $display = get_sub_field('display');
      if ($display) {
        echo '<div class="section__popup">';
        echo $button;
        echo '</div>';

        echo '
				<script type="text/javascript">
				$(window).on("load", function () {
				var $html =$(\'<div class="modal01"><div class="modal01__bg"><div class="modal01__content"><div class="modal01__close"></div><div class="modal01__inner"><div class="content">' . $string . '</div></div></div></div></div>\');
				$("body.under").append($html);

					function showModal_under() {
		        $(".under .modal01").fadeIn();
		        $(".under .modal01").addClass(\'active\');
            $(\'body\').addClass(\'lock\');
          }
					function closeModal_under() {
				    $(".modal01").fadeOut();
					  $(\'body\').removeClass(\'lock\');
          }
		      $(".under").on("click", ".modal01__close", function() {
					  closeModal_under();
			    });
			    $(".popup1").click(function (e) {
            e.preventDefault();
            showModal_under();
		    	});
          $(".under").on("click", ".modal01__bg", function (e) {
            if (!$(e.target).closest(".modal01__content").length) {
              closeModal_under();
            }
          });
        });

				</script>';
      }



    ?>
	

 <?php endwhile; ?>
 <?php endif; ?>