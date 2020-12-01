CREATE TABLE `t_admin` (
  `admin_id` int(7) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `email` varchar(256) DEFAULT NULL COMMENT 'メールアドレス',
  `password` varchar(256) NOT NULL COMMENT 'パスワード',
  `name` varchar(128) NOT NULL COMMENT '管理者名',
  `regist_time` datetime NOT NULL COMMENT '登録日',
  `update_time` datetime NOT NULL COMMENT '更新日',
  `status` varchar(1) DEFAULT '0' COMMENT '状態 0:通常 9:削除済',

  PRIMARY KEY (admin_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `t_apply` (
  `apply_id` int(7) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `type` varchar(1) NOT NULL COMMENT 'フォーム番号',
  `juku_name` varchar(128) NOT NULL COMMENT '塾名',
  `contact_name` varchar(128) NOT NULL COMMENT 'お名前',
  `position` varchar(64) DEFAULT NULL COMMENT '役職',
  `zip` varchar(16) NOT NULL COMMENT '郵便番号',
  `pref` varchar(2) NOT NULL COMMENT '都道府県',
  `addr1` varchar(128) NOT NULL COMMENT '住所1',
  `addr2` varchar(128) NOT NULL COMMENT '住所2',
  `tel` varchar(16) NOT NULL COMMENT '電話番号',
  `email` varchar(256) NOT NULL COMMENT 'Eメールアドレス',
  `know` varchar(1) NOT NULL COMMENT 'いつ知ったか',
  `other` varchar(128) DEFAULT NULL COMMENT 'その他の詳細',
  `regist_time` datetime NOT NULL COMMENT '登録日',
  `update_time` datetime NOT NULL COMMENT '更新日',
  `status` varchar(1) DEFAULT '0' COMMENT '状態 0:通常 9:削除済',

  PRIMARY KEY (apply_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
