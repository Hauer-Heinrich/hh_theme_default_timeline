#
# Table structure for table 'tt_content'
#
CREATE TABLE tt_content (
    {{EXTENSION_NAME}}_timeline_content int(11) unsigned DEFAULT '0' NOT NULL,
);

CREATE TABLE tx_{{EXTENSION_NAME}}_timeline_content (
    parentid int(11) DEFAULT '0' NOT NULL,
    parenttable text,

    header varchar(255) DEFAULT '' NOT NULL,
    description text,
    image int(11) unsigned DEFAULT '0' NOT NULL,
);
