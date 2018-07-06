<?php
/**
 * Adds Cryptoconverter widget.
 */
class Cryptoconverter_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'cryptoconverter_widget', // Base ID
			esc_html__( 'Cryptocurrency Converter', 'cryptoconv_domain' ), // Name
			array( 'description' => esc_html__( 'A Cryptocurrency Converter Widget', 'cryptoconv_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		
		$data = json_decode(@file_get_contents("http://blockchaincenter.de/tools/marketdata/api.php?method=rates&crypto=".$instance["crypto"]), true);
		if (is_array($data[$instance["crypto"]]))
		{
			
			$rate = $data[$instance["crypto"]][$instance["fiat"]];
			if ($rate != "")
			{
				echo $args['before_widget'];
				if ( ! empty( $instance['title'] ) ) {
					echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
				}
				
				$out = '
				<script>
				var crypto_rate='.$rate.';
				</script>
				<div id="cryptoconv">
					<div class="row">
						<div class="input-group">
							<div class="input-group-prepend">
							  <div class="input-group-text">'.$instance["crypto"].'</div>
							</div>
							<input type="text" class="form-control" id="crypto" name="crypto" value="1">
						</div>
						
						
					</div>
				
					<div class="row text-center">
					 &#8644;
					</div>
					<div class="row">
						<div class="input-group">
							<div class="input-group-prepend">
								  <div class="input-group-text">'.$instance["fiat"].'</div>
							</div>
							<input id="fiat" name="fiat"  class="form-control" type="text" value="">
						</div>
					</div>
					<div class="row powered">
					 <a href="https://www.blockchaincenter.net">&copy; Blockchaincenter.net</a>
					</div>
				</div>';
			}
			else $out = "Wrong Cryptocurrency code '".$instance["crypto"]."' or Fiat Code '".$instance["fiat"]."'";
		}
		else $out = "Connection problem with API";
		echo $out;
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Cryptocurrency converter', 'cryptoconv_domain' );
		$crypto = ! empty( $instance['crypto'] ) ? $instance['crypto'] : esc_html__( 'BTC', 'cryptoconv_domain' );
		$fiat = ! empty( $instance['fiat'] ) ? $instance['fiat'] : esc_html__( 'EUR', 'cryptoconv_domain' );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'cryptoconv_domain' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'crypto' ) ); ?>"><?php esc_attr_e( 'Cryptocurrency Code', 'cryptoconv_domain' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'crypto' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'crypto' ) ); ?>" type="text" value="<?php echo esc_attr( $crypto ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'fiat' ) ); ?>"><?php esc_attr_e( 'Fiat Code (EUR or USD)', 'cryptoconv_domain' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'fiat' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'fiat' ) ); ?>" type="text" value="<?php echo esc_attr( $fiat ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['crypto'] = ( ! empty( $new_instance['crypto'] ) ) ? sanitize_text_field( $new_instance['crypto'] ) : '';
		$instance['fiat'] = ( ! empty( $new_instance['fiat'] ) ) ? sanitize_text_field( $new_instance['fiat'] ) : '';

		return $instance;
	}

} // class Foo_Widget
?>