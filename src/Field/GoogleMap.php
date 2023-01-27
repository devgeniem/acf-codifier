<?php
/**
 * ACF Codifier GoogleMap field
 */

namespace Geniem\ACF\Field;

/**
 * Class GoogleMap
 */
class GoogleMap extends \Geniem\ACF\Field {

    /**
     * The field type
     *
     * @var string google_map
     */
    protected $type = 'google_map';

    /**
     * Map center latitude
     *
     * @var float
     */
    protected $center_lat;

    /**
     * Map center longitude
     *
     * @var float
     */
    protected $center_lng;

    /**
     * Map zoom level
     *
     * @var integer
     */
    protected $zoom;

    /**
     * Map height
     *
     * @var integer
     */
    protected $height;

    /**
     * What type the RediPress index field should be.
     *
     * @var string
     */
    protected $redipress_field_type = 'Geo';

    /**
     * Constructor.
     *
     * @param string      $label          Label for the field.
     * @param string|null $key            Key for the field.
     * @param string|null $name           Name for the field.
     * @throws \Geniem\ACF\Exception Throw error if mandatory property is not set.
     */
    public function __construct( string $label, string $key = null, string $name = null ) {
        parent::__construct( $label, $key, $name );

        $this->redipress_queryable_filter = function( $value ) {
            return $value['lat'] . ',' . $value['lng'];
        };
    }

    /**
     * Set center_lat variable
     *
     * @param  float $lat Latitude.
     * @return self
     */
    public function set_center_lat( float $lat ) : self {
        $this->center_lat = $lat;

        return $this;
    }

    /**
     * Get center_lat variable
     *
     * @return float
     */
    public function get_center_lat() : float {
        return $this->center_lat;
    }

    /**
     * Set center_lng variable
     *
     * @param  float $lng Longitude.
     * @return self
     */
    public function set_center_lng( float $lng ) : self {
        $this->center_lng = $lng;

        return $this;
    }

    /**
     * Get center_lng variable
     *
     * @return float
     */
    public function get_center_lng() : float {
        return $this->center_lng;
    }

    /**
     * Set zoom variable
     *
     * @param  integer $zoom Map zoom level.
     * @return self
     */
    public function set_zoom( int $zoom ) {
        $this->zoom = $zoom;

        return $this;
    }

    /**
     * Get zoom variable
     *
     * @return integer
     */
    public function get_zoom() {
        return $this->zoom;
    }

    /**
     * Set height variable
     *
     * @param  integer $height Map height.
     * @return self
     */
    public function set_height( int $height ) {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height variable
     *
     * @return integer
     */
    public function get_height() {
        return $this->height;
    }
}
