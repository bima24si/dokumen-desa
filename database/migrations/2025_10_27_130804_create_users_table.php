<?php
// Laravel - database/migrations/xxxx_xx_xx_xxxxxx_create_users_table.php
public function up()
{
    Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->string('password');
        $table->timestamps();
    });
}

// CodeIgniter 4 - app/Database/Migrations/xxxx_xx_xx_xxxxxx_CreateUsersTable.php
public function up()
{
    $this->forge->addField([
        'id' => [
            'type' => 'INT',
            'constraint' => 11,
            'unsigned' => true,
            'auto_increment' => true
        ],
        'name' => [
            'type' => 'VARCHAR',
            'constraint' => '255'
        ],
        'email' => [
            'type' => 'VARCHAR',
            'constraint' => '255',
            'unique' => true
        ],
        'password' => [
            'type' => 'VARCHAR',
            'constraint' => '255'
        ],
        'created_at' => [
            'type' => 'DATETIME',
            'null' => true
        ],
        'updated_at' => [
            'type' => 'DATETIME',
            'null' => true
        ]
    ]);
    $this->forge->addKey('id', true);
    $this->forge->createTable('users');
}
