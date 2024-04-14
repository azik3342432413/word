<?php 

class SelectSearchList {
    private $screen = array(
      'post',
      'page',
      'city',
    );
  
    private $meta_fields = array(
      array(
        'label' => 'Relationship between cities and apartments',
        'id' => 'real_estate',
        'type' => 'checkbox',
        'default' => '0',
      )
    );
  
    public function __construct() {
      add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
      add_action('admin_footer', array($this, 'media_fields'));
      add_action('save_post', array($this, 'save_real_estates'));
    }
  
    public function add_meta_boxes() {
      foreach ($this->screen as $single_screen) {
        add_meta_box(
          'RealEstate',
          __('Relationship between real estate and cities', 'text-domain'),
          array($this, 'meta_box_callback'),
          $single_screen,
          'normal',
          'default'
        );
      }
    }
  
    public function meta_box_callback($post) {
      wp_nonce_field('real_estate_data', 'real_estate_nonce');
      $this->field_generator($post);
    }
    public function media_fields() { ?>
    
    <?php 
    }
  
  
  
  
    public function field_generator($post) {
      $output = '';
      foreach ($this->meta_fields as $meta_field) {
  
          $series = new WP_Query( array(
              'post_type' => 'real-estate',
              'nopaging' => true
          ));
  
          $pg = get_the_ID();
          $real_estates = [];
          $real_estates_selected = [];
  
  
          
          if ( $series-> have_posts() ) { while ( $series->have_posts() ) {
              $series->the_post();
              
              $post_id = get_the_ID();
              $post_title = get_the_title();
              $real_estates[] = ['id' => $post_id, 'name' => $post_title];
  
              $meta_value = get_post_meta($pg, 'real_estate', true);
              if(!is_array($meta_value)) $meta_value = [];

              if(in_array($post_id, $meta_value)) $real_estates_selected[] = ['id' => $post_id, 'name' => $post_title];

  
  
              $label = '<label for="' . $meta_field['id'].'_'.$post_id . '">' .$post_title. '</label>';
              // $meta_value = get_post_meta($post->ID, $meta_field['id'], true);
              // if (empty($meta_value)) {
              //   if (isset($meta_field['default'])) {
              //     $meta_value = $meta_field['default'];
              //   }
              // }
  
                
              
              switch ($meta_field['type']) {
        
                case 'checkbox':
                  // $input = sprintf(
                  //   '<input%s id=" %s" name="%s[]" type="checkbox" value="'.$post_id.'">',
                  //   $meta_value === '1' ? ' checked' : '',
                  //   $meta_field['id'].'_'.$post_id,
                  //   $meta_field['id']
                  // );
  
                  $input_fields = '
                  <ul style="display: none;">
                    <li v-for="item in real_estate_selected" :key="item.id">'. sprintf(
                      '<input%s id=" %s" name="%s[]" type="checkbox" :value="item.id" checked>',
                      $meta_value === '1' ? ' checked' : '',
                      $meta_field['id'].'_'.$post_id,
                      $meta_field['id']
                    ).'</li>
                  </ul>';
  
                  break;
              }
              //$output .= $this->format_rows($label, $input);
  
              
           
  
              ?>
              <?php 
          } 
        }
      }
  
  
  
  
      echo "<script> const real_estates = ".json_encode($real_estates).";</script>";
      echo "<script> const real_estate_selected = ".json_encode($real_estates_selected).";</script>";
  
      echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
      echo '<div id="real-estate"><vue-multiselect v-model="real_estate_selected"
                :options="real_estates"
                :multiple="true"
                :close-on-select="true"
                placeholder="Pick some"
                label="name"
                track-by="name"> </vue-multiselect>
                
                '.$input_fields.'</div>';
  
    }
  
    public function format_rows($label, $input) {
      return '<tr><th>' . $label . '</th><td>' . $input . '</td></tr>';
    }
  
    public function save_real_estates( $post_id ) {
  
  
      if (!isset($_POST['real_estate_nonce'])) {
        
        return $post_id;
  
      }
        $nonce = $_POST['real_estate_nonce'];
        if (!wp_verify_nonce($nonce, 'real_estate_data'))
          return $post_id;
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
          return $post_id;
        foreach ($this->meta_fields as $meta_field) {
          if (isset($_POST[$meta_field['id']])) {
            switch ($meta_field['type']) {
              case 'email':
                $_POST[$meta_field['id']] = sanitize_email($_POST[$meta_field['id']]);
                break;
              case 'text':
                $_POST[$meta_field['id']] = sanitize_text_field($_POST[$meta_field['id']]);
                break;
            }
            update_post_meta($post_id, $meta_field['id'], $_POST[$meta_field['id']]);
          } else if ($meta_field['type'] === 'checkbox') {
            update_post_meta($post_id, $meta_field['id'], '0');
          }
        }
    }
  }
  
  if (class_exists('SelectSearchList')) {
    new SelectSearchList;
  };
  
  