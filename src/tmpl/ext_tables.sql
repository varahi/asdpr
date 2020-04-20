#
# Table structure for table 'tt_content'
#
CREATE TABLE tt_content (
  spaceBefore smallint (5) DEFAULT '' NOT NULL,
  spaceAfter smallint (5) DEFAULT '' NOT NULL,
  cropscaling tinyint(3) DEFAULT '0' NOT NULL,
  cropscaling_ratio varchar(100) DEFAULT '0' NOT NULL,
  cropscaling_orient tinyint(3) DEFAULT '0' NOT NULL,
  textfield text,
  is_last smallint(5) unsigned DEFAULT '0' NOT NULL,
);

#
# Table structure for table 'pages'
#
CREATE TABLE pages (
	page_title varchar(100) DEFAULT '' NOT NULL,
	page_description text,
);

# additional fields for news
CREATE TABLE tx_news_domain_model_news (
    display_date date DEFAULT NULL,
);