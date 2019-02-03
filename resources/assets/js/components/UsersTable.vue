<template>
    <v-client-table :columns="columns" :data="users" :options="options">
        <div slot="actions" slot-scope="props">
            <div class="field has-addons">
                <p class="control">
                    <a class="button is-info is-small">
                        <span class="icon is-small">
                            <i class="fas fa-eye"></i>
                        </span>
                    </a>
                    <a class="button is-warning is-small">
                        <span class="icon is-small">
                            <i class="fas fa-edit"></i>
                        </span>
                    </a>
                    <a class="button is-danger is-small">
                        <span class="icon is-small">
                            <i class="fas fa-trash"></i>
                        </span>
                    </a>
                </p>
            </div>
        </div>
    </v-client-table>
</template>

<script>
    export default {
        name: "UsersTable",
        data() {
            axios.get("/api/users").then(users => this.users = users.data);
            return {
                columns: ["id", "first_name", "last_name", "email",
                    "created_at", "updated_at", "deleted_at", "actions"],
                options: {
                    sortable: true,
                    filterable: true
                },
                users: [],
            }
        }
    }
</script>

<style scoped>

</style>