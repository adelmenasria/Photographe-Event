<div class="filters">
  <div class="filter">
    <?php
    wp_dropdown_categories(array(
      'show_option_none' => 'Catégories',
      'option_none_value' => 'default-category',
      'taxonomy'         => 'photo_category',
      'name'             => 'categories',
      'id'               => 'filter-category',
      'class'            => 'filter-category',
      'hide_empty'       => false,
      'value_field'      => 'slug'
    ));
    ?>
    <span class="i-chevron-down"></span>
  </div>
  <div class="filter">
    <?php
    wp_dropdown_categories(array(
      'show_option_none' => 'Formats',
      'option_none_value' => 'default-format',
      'taxonomy'         => 'photo_format',
      'name'             => 'formats',
      'id'               => 'filter-format',
      'class'            => 'filter-format',
      'hide_empty'       => false,
      'value_field'      => 'slug'
    ));
    ?>
    <span class="i-chevron-down"></span>
  </div>
  <div class="filter">
    <select name="sort" id="filter-order" class="filter-order">
      <option value="default-sort">Trier par</option>
      <option value="new">Plus récent</option>
      <option value="old">Plus ancien</option>
    </select>
    <span class="i-chevron-down"></span>
  </div>
</div>