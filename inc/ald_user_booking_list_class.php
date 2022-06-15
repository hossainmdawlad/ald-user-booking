<?php
/**
 * Create a new table class that will extend the WP_List_Table
 */
class Booking_List_Table extends WP_List_Table
{
    /**
     * Prepare the items for the table to process
     *
     * @return Void
     */
    public function prepare_items()
    {
        $columns = $this->get_columns();
        $hidden = $this->get_hidden_columns();
        $sortable = $this->get_sortable_columns();

        $data = $this->table_data();
        usort( $data, array( &$this, 'sort_data' ) );

        $perPage = 5;
        $currentPage = $this->get_pagenum();
        $totalItems = count($data);

        $this->set_pagination_args( array(
            'total_items' => $totalItems,
            'per_page'    => $perPage
        ) );

        $data = array_slice($data,(($currentPage-1)*$perPage),$perPage);

        $this->_column_headers = array($columns, $hidden, $sortable);
        $this->items = $data;
    }

    /**
     * Override the parent columns method. Defines the columns to use in your listing table
     *
     * @return Array
     */
    public function get_columns()
    {
        $columns = array(
            'booking_date'          => 'Booking Date',
            'user'       => 'User',
            'booking_quantity' => 'Quantity',
            'note'        => 'Note',
            'feedback'    => 'Feedback',
            'updated_at'    => 'Updated'
        );

        return $columns;
    }

    /**
     * Define which columns are hidden
     *
     * @return Array
     */
    public function get_hidden_columns()
    {
        return array();
    }

    /**
     * Define the sortable columns
     *
     * @return Array
     */
    public function get_sortable_columns()
    {
        return array('booking_date' => array('booking_date', false));
    }

    /**
     * Get the table data
     *
     * @return Array
     */
    private function table_data()
    {
        $data = array();
		global $wpdb;
		$ald_user_booking_table = ALD_USER_BOOKING_TABLE;
        $user_table = ALD_USER_TABLE;
		$results = $wpdb->get_results("SELECT $ald_user_booking_table.`booking_date` as booking_date, 
                            $user_table.display_name AS user ,
                            $ald_user_booking_table.`booking_quantity` as booking_quantity,
                            $ald_user_booking_table.`note` as note,
                            $ald_user_booking_table.`feedback` as feedback,
                            $ald_user_booking_table.`updated_at` as updated_at 
                            FROM $ald_user_booking_table 
        INNER JOIN $user_table ON 
        $ald_user_booking_table.`user_id`=`$user_table`.`ID`");

		foreach ( $results as $booking )
		{
            $data[] = array(
				'booking_date'        => esc_html($booking->booking_date),
				'user'   => esc_html($booking->user),
				'booking_quantity' => esc_html($booking->booking_quantity),
				'note'      => esc_html($booking->note),
				'feedback'      => esc_html($booking->feedback),
				'updated_at'      => esc_html($booking->updated_at),
			);
		}
        return $data;
    }

    /**
     * Define what data to show on each column of the table
     *
     * @param  Array $item        Data
     * @param  String $column_name - Current column name
     *
     * @return Mixed
     */
    public function column_default( $item, $column_name )
    {
        switch( $column_name ) {
            case 'booking_date':
            case 'user':
            case 'booking_quantity':
            case 'note':
            case 'feedback':
            case 'updated_at':
                return $item[ $column_name ];

            default:
                return print_r( $item, true ) ;
        }
    }

    /**
     * Allows you to sort the data by the variables set in the $_GET
     *
     * @return Mixed
     */
    private function sort_data( $a, $b )
    {
        // Set defaults
        $orderby = 'booking_date';
        $order = 'asc';

        // If orderby is set, use this as the sort column
        if(!empty($_GET['orderby']))
        {
            $orderby = $_GET['orderby'];
        }

        // If order is set use this as the order
        if(!empty($_GET['order']))
        {
            $order = $_GET['order'];
        }


        $result = strcmp( $a[$orderby], $b[$orderby] );

        if($order === 'asc')
        {
            return $result;
        }

        return -$result;
    }

    function search_box( $text, $input_id ) {
        if ( empty( $_REQUEST['s'] ) && !$this->has_items() )
            return;
    
        $input_id = $input_id . '-search-input';
    
        if ( ! empty( $_REQUEST['orderby'] ) )
            echo '<input type="hidden" name="orderby" value="' . esc_attr( $_REQUEST['orderby'] ) . '" />';
        if ( ! empty( $_REQUEST['order'] ) )
            echo '<input type="hidden" name="order" value="' . esc_attr( $_REQUEST['order'] ) . '" />';
        if ( ! empty( $_REQUEST['post_mime_type'] ) )
            echo '<input type="hidden" name="post_mime_type" value="' . esc_attr( $_REQUEST['post_mime_type'] ) . '" />';
        if ( ! empty( $_REQUEST['detached'] ) )
            echo '<input type="hidden" name="detached" value="' . esc_attr( $_REQUEST['detached'] ) . '" />';
    ?>
    <p class="search-box">
    <label class="screen-reader-text" for="<?php echo $input_id ?>"><?php echo $text; ?>:</label>
    <input type="search" id="<?php echo $input_id ?>" name="s" value="<?php _admin_search_query(); ?>" />
    <?php submit_button( $text, 'button', false, false, array('id' => 'search-submit') ); ?>
    </p>
    <?php
    }

}