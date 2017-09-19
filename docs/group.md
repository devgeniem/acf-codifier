# ACF Codifier

## Field Group

- class name: Group

### Available methods

**clone**
- parameters: string $key, string name = _null_
- returns:    Group object

You can clone a field group with this method. It requires that you give it a new field group key, because they are supposed to be unique.

**export**
- parameters: none
- return:     array

This function exports the field group object in ACF's native array format. Usually needed only for Codifier's internal purposes.

**set_title**
- parameters: string $title
- return:     _self_

Sets a new title for the field group.

**get_title**
- parameters: none
- return:     string

Returns the current title of the field group.

**set_key**
- parameters: string $key
- return      _self_

Sets a new key for the field group.

**get_key**
- parameters: none
- return:     string

Returns the current key of the field group.

**set\_menu\_order**
- parameters: int $order = 0
- return:     _self_

Sets the menu order property for the field group.

**get\_menu\_order**
- parameters: none
- return:     int

Returns the current menu order of the field group.

**set_position**
- parameters: string $position = 'normal'
- return:     _self_

Sets the field group's position within the edit screen.

**get_position**
- parameters: none
- return:     string

Returns the current value of the position property of the field group.

**set_style**
- parameters: string $style = 'default'
- return:     _self_

Sets the display style parameter of the field group.

**get_style**
- parameters: none
- return:     string

Returns the display style parameter of the field group.

**set\_label\_placement**
- parameters: string $placement = 'top'
- return:     _self_