# WP CLI Serialised Options

`wp option get xyz` may return the string 'array' if it's a PHP array serialised. This is great for humans, but awful for automation. This plugin provides a way of getting and setting option values, serialised and base64 encoded to prevent corruption. This plugin is intended for bash script automation not human readable values.

## Usage

```
data=$(wp serialised_option export --option="twp")

wp serialised_option import --option="twp" --value="$data"
```