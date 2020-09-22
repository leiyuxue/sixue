<?php

return [
    'alipay' => [
        'app_id'         => '2016101000650483',
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAlw5TeMEsD/BWGeVILrSsnQfv6moDOGjwgrz8RITreiF+2xQX2sWDnrjxotRlKpAfKrDvpgeMo3UN/R1esb5KOePb8wWuQ1bp023SvBrFzwcsISOfr2xFuhhoKnKOPGKWS3MtMHeAA9NqjF84XuwevhwokGc8lsxO39Mk3RhmqpNFMlQyFXo91+t91ZLx1TbDQZRD6x92gdXX68A4artBljqTXlz0mB3Gberq7ofrUyLKL9yKY16xOI1NsERIs8MRKclC40JIa7VDhSIjcvmuGUQ11hkWjH+nUVq6jc69pCpkEpEjE52qvnu8GtbFZAs0jdtSjwpRbHUWVgzNmhUpsQIDAQAB',
        'private_key'    => 'MIIEpAIBAAKCAQEAwYTr0ARqQUSTwYJvenp4l26HtcpNLI4/J+/bk/gKktYdNy5ppmm9qN4FJvPkyegZI9wMN+jpTaIRi0ro7tMI4hdWHpMe3xz/2Tv0GA+GMfkSrMZm7xABOMihqhPcpLATufD+5Drwllrognti9kEZ9LV1JvkE7YoEFGkAdgQiW0iQBaeGUL3HXHUFYpffQ3vxBRYaMHvqq1eL3g4po6FjOVO+O3p2sZz5fDXa1/nLrDCaG9Z2jjpGRw52JxCfhXGgYPbgfm3pjpwmj8ZWJ5zE67ITzah/woDBo8KVhR+MnVWlyptOmwL04t9E+19RGmKt8kNEVVbD1GZBmoXgyPC1gQIDAQABAoIBACK/s3hO0qWVotKEkW/0veKzPjsucF0nzb9mGo+fYoarW+OkuePf6OaBt3sfIF4BB0KhKLCBaiM+jtfsQ5de3aF7f0NON6TomChx04refsJKb0gG+ETFIvMHU8AugNgxpdklpR9mVf0ppcaIUWTWm8qNKtQssu3UcpcXo7WNWH37YbHVYV0VL4vpIwZlXQ/KrUrMbIx8AjKySAVs6D3Y9E1A4/LkZBugWn32qaHiOwbPjf1CkbDzvucNTD4nQALxSmJah15597URW+TCSGu5Szu3A/IhHxo184EJJMSikDLVKT7z0O2upbptNbsPP7DRIJM5unh4Ya50PS+8NQAkgAECgYEA3wsJGC4z4fUy+8JrJiQR0BQkYYciFvqUx/QoBXMJhVSJyGcsqe2rYeyqmiI8dnBSoKB/vpRH8pQNIACieoZArBg8EOzxjhRR3ZbwTVpamnL8UHdeNsbfXTbdZKIDw+WtBGlg6L6wiUobHYAOe6kewvTQ4Lwemsrh7Gzxy9S8KkECgYEA3h0Y4PElNJBQgV6OdBgcZm9A63V6ObNypttY4PQtqTODGne2PYmL0x2zz5PkuzGLB/7k7M4lfsxSiZaavIfHBwANQ6ATSC5jrDX18YZj815h4yjuizdjI4ijoQL4hktLb1fk831PYzhJ+xkNxZqqvXkiCWcJTJCcRRSpYnotO0ECgYEA0+hPLqsO3foxAyKW3Hjed5v7aLGTwNM4MbUVpP/DpupHsZ/cvmGxN2s8Nw6Z9UkIJ9X1KGMG7ECfK62OsOwGW7r2rnn/kaZalTYHfuZ+OElQ0T5nw5E0vAIZW7fV7fOzawKXcOljHjzLAD8fA3wNXtpr7WithxGEjjR/kdG/KEECgYAOrMl6AzS8FlTbV03+KaGmuu8FH4vlyA9pKtDie/+QUFD3LLWjtzS/zBSXQGQ6YfmXm6WwZ6ZejE1fvc2XazkhI0W9FBRyDm6TcDVBselkqPW6tnecRxqLvHljJ/kXll3zi1EbLUpTeeKZbnxUc/WX8yrmiCI7JsrMXaMbWIsogQKBgQCyhCOvluDtlVJQs5WpisMhlsuQ4Chcxxhdh/uKrtIxFbrAMMe6S0oAN+Hlp+l+NF+5k9tqviIPH5ZUsKKxTXyZHVmgoEiwNe/xaHPYQUy3OKbupOHzjGDZzP25rZUDxdtp0heuROK7ngO9+Fth8X2AWxU7ExzJlUpfnmyW34qCew==',
        'log'            => [
            'file' => storage_path('logs/alipay.log'),
        ],
    ],

    'wechat' => [
        'app_id'      => '',
        'mch_id'      => '',
        'key'         => '',
        'cert_client' => '',
        'cert_key'    => '',
        'log'         => [
            'file' => storage_path('logs/wechat_pay.log'),
        ],
    ],
];
