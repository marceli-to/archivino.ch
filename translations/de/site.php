<?php
/**
 * Express Forms for Craft.
 *
 * @author        Solspace, Inc.
 * @copyright     Copyright (c) 2019-2020, Solspace, Inc.
 *
 * @see          https://craft.express/forms/v1/
 *
 * @license       https://docs.solspace.com/license-agreement/
 */

return [
    // Field validation
    'Email address is not valid' => 'E-Mail Adresse scheint ungültig zu sein',
    'This field is required' => 'Dieses Feld ist ein Pflichtfeld',
    'Please verify that you are not a robot.' => 'Please verify that you are not a robot.',

    // File Upload validation
    'Tried uploading {count} files. Maximum {max} files allowed.' => 'Tried uploading {count} files. Maximum {max} files allowed.',
    'File size too large' => 'File size too large',
    'The file was only partially uploaded' => 'The file was only partially uploaded',
    'Could not upload file' => 'Could not upload file',
    "'{extension}' is not an allowed file extension" => "'{extension}' is not an allowed file extension",
    'You tried uploading {fileSize}KB, but the maximum file upload size is {maxFileSize}KB' => 'You tried uploading {fileSize}KB, but the maximum file upload size is {maxFileSize}KB',

    // CP Submissions
    'Submissions' => 'Einsendungen',
    'Submission' => 'Einsendung',
    'Date' => 'Datum',
    'Value' => 'Wert',
    'Submission with ID {id} not found' => 'Submission with ID {id} not found',
    'Submission not found' => 'Submission not found',
    'Submission updated' => 'Submission updated',
    'Submission could not be updated' => 'Submission could not be updated',
    'Delete...' => 'Löschen...',
    'Forms' => 'Formulare',
    'Form' => 'Formular',
    'Element ID' => 'Element ID',
    'ID' => 'ID',
    'Title' => 'Titel',
    'Date Created' => 'Datum der Erstellung',
    'Date Updated' => 'Datum der Aktualisierung',
    'Are you sure you want to delete the selected submissions?' => 'Are you sure you want to delete the selected submissions?',
    'Submissions deleted.' => 'Submissions deleted.',
    'Submissions restored.' => 'Submissions restored.',
    'Some submissions restored.' => 'Some submissions restored.',
    'Submissions not restored.' => 'Submissions not restored.',
    'yes' => 'yes',
    'no' => 'no',

    // CP Email Notifications
    'Email Notifications' => 'Email Notifications',
    'Template Directory Path' => 'Template Directory Path',
    'Provide a path relative to the Craft Templates folder where your email templates directory is. The directory must be writeable to allow Express Forms to create and edit existing templates.' => 'Provide a path relative to the Craft Templates folder where your email templates directory is. The directory must be writeable to allow Express Forms to create and edit existing templates.',
    'Edit Template' => 'Edit Template',
    'Templates' => 'Templates',
    'Express Forms uses the above path to locate and read the available notification template files in your Craft Templates directory on your server and populates a list of them here. Be sure to have proper file permissions set. Editing of notification templates can be done directly inside the file as well.' => 'Express Forms uses the above path to locate and read the available notification template files in your Craft Templates directory on your server and populates a list of them here. Be sure to have proper file permissions set. Editing of notification templates can be done directly inside the file as well.',
    'There are no templates in this folder yet.' => 'There are no templates in this folder yet.',
    'No email notification templates folder set.' => 'No email notification templates folder set.',
    'Incorrect email notification templates folder set.' => 'Incorrect email notification templates folder set.',
    'Create a new Notification Template' => 'Create a new Notification Template',
    'Notification deleted successfully' => 'Notification deleted successfully',
    'Could not delete notification' => 'Could not delete notification',
    'Malformed email notification template "{filename}" in "{path}"' => 'Malformed email notification template "{filename}" in "{path}"',
    'Email notification template folder not set' => 'Email notification template folder not set',
    'New Template' => 'New Template',
    'Express Forms reads the file in your Craft Templates directory on your server and populates an intuitive form for editing the file. Be sure to have proper file permissions set. Editing of this notification template can be done directly inside the file as well.' => 'Express Forms reads the file in your Craft Templates directory on your server and populates an intuitive form for editing the file. Be sure to have proper file permissions set. Editing of this notification template can be done directly inside the file as well.',
    'Are you sure you want to delete this email notification?' => 'Are you sure you want to delete this email notification?',
    'Delete' => 'Delete',
    'Update' => 'Update',
    'The name of the notification.' => 'The name of the notification.',
    'File Name' => 'File Name',
    'The file name of the notification. Only `.twig` or `.html` extensions are valid.' => 'The file name of the notification. Only `.twig` or `.html` extensions are valid.',
    'Description' => 'Description',
    'Description of this notification.' => 'Description of this notification.',
    'From Name' => 'From Name',
    'The name that the email will appear from in your email notification.' => 'The name that the email will appear from in your email notification.',
    'From Email' => 'From Email',
    'The email address that the email will appear from in your email notification.' => 'The email address that the email will appear from in your email notification.',
    'Reply-to Email' => 'Reply-to Email',
    "The reply-to email address for your email notification. Leave blank to use 'From Email' address." => "The reply-to email address for your email notification. Leave blank to use 'From Email' address.",
    'CC' => 'CC',
    'The CC email address for your email notification. Leave blank to not use any.' => 'The CC email address for your email notification. Leave blank to not use any.',
    'BCC' => 'BCC',
    'The BCC email address for your email notification. Leave blank to not use any.' => 'The BCC email address for your email notification. Leave blank to not use any.',
    'Subject' => 'Subject',
    'The subject line that will appear in your email notification.' => 'The subject line that will appear in your email notification.',
    'Email Body' => 'Email Body',
    'The content of the email notification. See documentation for availability of variables.' => 'The content of the email notification. See documentation for availability of variables.',
    'Include Attachments?' => 'Include Attachments?',
    'Include uploaded files as attachments in email notification.' => 'Include uploaded files as attachments in email notification.',

    // Widgets
    'Overview Stats' => 'Overview Stats',
    'Line' => 'Line',
    'Bar' => 'Bar',
    'Last 24 hours' => 'Last 24 hours',
    'Last 7 days' => 'Last 7 days',
    'Last 30 days' => 'Last 30 days',
    'Last 60 days' => 'Last 60 days',
    'Last 90 days' => 'Last 90 days',
    "Requires <a href='{link}'>Pro</a> edition" => "Requires <a href='{link}'>Pro</a> edition",
];
