<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ':attribute harus disetujui.',
    'active_url'           => ':attribute bukan URL yang valid.',
    'after'                => ':attribute harus berupa tanggal setelah :date.',
    'after_or_equal'       => ':attribute harus berupa tanggal setelah atau sama dengan :date.',
    'alpha'                => ':attribute hanya boleh berisi hurup.',
    'alpha_dash'           => ':attribute hanya boleh berisi hurup, angka dan tanda hubung (-).',
    'alpha_num'            => ':attribute hanya boleh berisi hurup dan angka.',
    'array'                => ':attribute harus berupa array.',
    'before'               => ':attribute harus berupa tanggal sebelum :date.',
    'before_or_equal'      => ':attribute harus berupa tanggal sebelum atau sama dengan :date.',
    'between'              => [
        'numeric' => ':attribute harus antara :min dan :max.',
        'file'    => ':attribute harus antara :min dan :max kilobytes.',
        'string'  => ':attribute harus antara :min dan :max karakter.',
        'array'   => ':attribute harus antara :min dan :max item.',
    ],
    'boolean'              => ':attribute harus antara true atau false.',
    'confirmed'            => ':attribute konfirmasi tidak sama.',
    'date'                 => ':attribute bukan tanggal yang valid.',
    'date_format'          => ':attribute tidak sesuai format :format.',
    'different'            => ':attribute dan :other harus berbeda.',
    'digits'               => ':attribute harus :digits digit.',
    'digits_between'       => ':attribute harus antara :min dan :max digit.',
    'dimensions'           => ':attribute memiliki dimensi gambar yang tidak valid.',
    'distinct'             => 'Field :attribute memiliki nilai duplikat.',
    'email'                => ':attribute harus berupa alamat email yang valid.',
    'exists'               => ':attribute tidak benar.',
    'file'                 => ':attribute harus berupa file.',
    'filled'               => ':attribute harus memiliki nilai.',
    'image'                => ':attribute harus berupa gambar.',
    'in'                   => ':attribute yang dipilih tidak valid.',
    'in_array'             => 'Field :attribute tidak ada dalam :other.',
    'integer'              => ':attribute harus berupa integer.',
    'ip'                   => ':attribute harus berupa alamat IP yang valid.',
    'json'                 => ':attribute harus berupa JSON string yang valid.',
    'max'                  => [
        'numeric' => ':attribute tidak boleh lebih besar dari :max.',
        'file'    => ':attribute tidak boleh melebihi :max kilobytes.',
        'string'  => ':attribute tidak boleh melebihi :max karakter.',
        'array'   => ':attribute tidak boleh melebihi :max item.',
    ],
    'mimes'                => ':attribute harus berupa file dengan tipe: :values.',
    'mimetypes'            => ':attribute harus berupa file dengan tipe: :values.',
    'min'                  => [
        'numeric' => ':attribute harus setidaknya :min.',
        'file'    => ':attribute harus setidaknya :min kilobytes.',
        'string'  => ':attribute harus setidaknya :min karakter.',
        'array'   => ':attribute harus setidaknya :min item.',
    ],
    'not_in'               => ':attribute yang dipilih tidak valid.',
    'numeric'              => ':attribute harus berupa angka.',
    'present'              => 'Field :attribute harus ditampilkan.',
    'regex'                => 'Format :attribute tidak benar.',
    'required'             => 'Field :attribute wajib diisi.',
    'required_if'          => 'Field :attribute wajib diisi ketika :other adalah :value.',
    'required_unless'      => 'Field :attribute wajib diisi kecuali :other berada dalam :values.',
    'required_with'        => 'Field :attribute wajib diisi ketika :values ditampilkan.',
    'required_with_all'    => 'Field :attribute wajib diisi ketika :values ditampilkan.',
    'required_without'     => 'Field :attribute wajib diisi ketika :values tidak ditampilkan.',
    'required_without_all' => 'Field :attribute wajib diisi bila tidak ada :values yang ditampilkan.',
    'same'                 => ':attribute dan :other harus sama.',
    'size'                 => [
        'numeric' => ':attribute harus berukuran :size.',
        'file'    => ':attribute harus berukuran :size kilobytes.',
        'string'  => ':attribute harus berukuran :size karakter.',
        'array'   => ':attribute harus berisi :size item.',
    ],
    'string'               => ':attribute harus berupa string.',
    'timezone'             => ':attribute harus berupa zona yang benar.',
    'unique'               => ':attribute sudah ada, silakan coba yang lain.',
    'uploaded'             => ':attribute gagal diupload.',
    'url'                  => 'Format :attribute tidak valid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
