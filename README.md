CI_Mailchimp_v2
===============

Simple and minimal Mailchimp API V2 for Codeigniter


Installation
===============

1) Exctract and copy the files in the root of your Codeigniter installation root folder.
2) Modify the `application/config/mailchimp.php` file configuration.
3) Load the library and use it.

Example
===============

Retrieve all of the lists defined for your user account

```
    $this->load->library('mailchimp_library');
    $lists = $this->mailchimp_library->call('lists/list');
    var_dump($lists);
```
