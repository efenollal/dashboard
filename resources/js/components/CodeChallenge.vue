<template>
    <application>
        <template v-slot:content>
            <v-container class="pa-4" fluid>
                <v-card>
                    <v-card-title>
                        Code Challenge
                    </v-card-title>
                    <v-card-text>
                        <v-alert type="info">
                            This page outlines requirements of the code challenge.
                        </v-alert>
                        <v-list subheader two-line flat>
                            <v-subheader>Dashboard</v-subheader>
                            <v-list-item-group v-model="checklist" multiple>
                                <v-list-item value="active_domains">
                                    <template v-slot:default="{ active, toggle }">
                                        <v-list-item-action>
                                            <v-checkbox :input-value="active" color="primary" @click="toggle"/>
                                        </v-list-item-action>
                                        <v-list-item-content>
                                            <v-list-item-title>Active Domains</v-list-item-title>
                                            <v-list-item-subtitle>
                                                Make the <strong>active domains</strong> stat display the total number of domains excluding soft deletes.
                                            </v-list-item-subtitle>
                                        </v-list-item-content>
                                    </template>
                                </v-list-item>
                                <v-list-item value="trashed_domains">
                                    <template v-slot:default="{ active, toggle }">
                                        <v-list-item-action>
                                            <v-checkbox :input-value="active" color="primary" @click="toggle"/>
                                        </v-list-item-action>
                                        <v-list-item-content>
                                            <v-list-item-title>Trashed Domains</v-list-item-title>
                                            <v-list-item-subtitle>
                                                Make the <strong>trashed domains</strong> stat display the total number of domains that have been soft deleted.
                                            </v-list-item-subtitle>
                                        </v-list-item-content>
                                    </template>
                                </v-list-item>
                                <v-list-item value="internationalized_domains">
                                    <template v-slot:default="{ active, toggle }">
                                        <v-list-item-action>
                                            <v-checkbox :input-value="active" color="primary" @click="toggle"/>
                                        </v-list-item-action>
                                        <v-list-item-content>
                                            <v-list-item-title>Internationalized Domains</v-list-item-title>
                                            <v-list-item-subtitle>
                                                Make the <strong>internationalized domains</strong> stat display the total number of domains flagged as internationalized.
                                            </v-list-item-subtitle>
                                        </v-list-item-content>
                                    </template>
                                </v-list-item>
                                <v-list-item value="imprinted_domains">
                                    <template v-slot:default="{ active, toggle }">
                                        <v-list-item-action>
                                            <v-checkbox :input-value="active" color="primary" @click="toggle"/>
                                        </v-list-item-action>
                                        <v-list-item-content>
                                            <v-list-item-title>Imprinted Domains</v-list-item-title>
                                            <v-list-item-subtitle>
                                                Make the <strong>imprinted domains</strong> stat display the total number of domains flagged as imprinted.
                                            </v-list-item-subtitle>
                                        </v-list-item-content>
                                    </template>
                                </v-list-item>
                            </v-list-item-group>

                            <v-divider></v-divider>

                            <v-subheader>Domains</v-subheader>
                            <v-list-item-group v-model="checklist" multiple>
                                <v-list-item value="search_filter">
                                    <template v-slot:default="{ active, toggle }">
                                        <v-list-item-action>
                                            <v-checkbox :input-value="active" color="primary" @click="toggle"/>
                                        </v-list-item-action>
                                        <v-list-item-content>
                                            <v-list-item-title>Search Filter</v-list-item-title>
                                            <v-list-item-subtitle>
                                                Make the <strong>search input field</strong> filter the domains displayed by the table.
                                            </v-list-item-subtitle>
                                        </v-list-item-content>
                                    </template>
                                </v-list-item>
                                <v-list-item value="add_domains">
                                    <template v-slot:default="{ active, toggle }">
                                        <v-list-item-action>
                                            <v-checkbox :input-value="active" color="primary" @click="toggle"/>
                                        </v-list-item-action>
                                        <v-list-item-content>
                                            <v-list-item-title>Add Domains</v-list-item-title>
                                            <v-list-item-subtitle>
                                                Make the <strong>add domains form</strong> store new domains.
                                            </v-list-item-subtitle>
                                        </v-list-item-content>
                                    </template>
                                </v-list-item>
                                <v-list-item value="delete_domains">
                                    <template v-slot:default="{ active, toggle }">
                                        <v-list-item-action>
                                            <v-checkbox :input-value="active" color="primary" @click="toggle"/>
                                        </v-list-item-action>
                                        <v-list-item-content>
                                            <v-list-item-title>Delete Domains</v-list-item-title>
                                            <v-list-item-subtitle>
                                                Make the <strong>delete icon</strong> soft delete a domain.
                                            </v-list-item-subtitle>
                                        </v-list-item-content>
                                    </template>
                                </v-list-item>
                                <v-list-item value="toggle_imprint">
                                    <template v-slot:default="{ active, toggle }">
                                        <v-list-item-action>
                                            <v-checkbox :input-value="active" color="primary" @click="toggle"/>
                                        </v-list-item-action>
                                        <v-list-item-content>
                                            <v-list-item-title>Toggle Imprint</v-list-item-title>
                                            <v-list-item-subtitle>
                                                Make the <strong>imprint icon</strong> toggle the imprint flag for a domain.
                                            </v-list-item-subtitle>
                                        </v-list-item-content>
                                    </template>
                                </v-list-item>
                            </v-list-item-group>

                            <v-divider></v-divider>

                            <v-subheader>Settings</v-subheader>
                            <v-list-item-group v-model="checklist" multiple>
                                <v-list-item value="dark_mode">
                                    <template v-slot:default="{ active, toggle }">
                                        <v-list-item-action>
                                            <v-checkbox :input-value="active" color="primary" @click="toggle"/>
                                        </v-list-item-action>
                                        <v-list-item-content>
                                            <v-list-item-title>Dark Mode</v-list-item-title>
                                            <v-list-item-subtitle>
                                                Make the <strong>dark mode</strong> setting toggle appearance of the user interface.
                                            </v-list-item-subtitle>
                                        </v-list-item-content>
                                    </template>
                                </v-list-item>
                            </v-list-item-group>

                            <v-divider></v-divider>

                            <v-subheader>Bonus</v-subheader>
                            <v-list-item-group v-model="checklist" multiple>
                                <v-list-item value="flag_internationlized_domains">
                                    <template v-slot:default="{ active, toggle }">
                                        <v-list-item-action>
                                            <v-checkbox :input-value="active" color="primary" @click="toggle"/>
                                        </v-list-item-action>
                                        <v-list-item-content>
                                            <v-list-item-title>Flag Internationalized Domains</v-list-item-title>
                                            <v-list-item-subtitle>
                                                Make the <strong>add domains form</strong> flag a domain as internationalized when saving.
                                            </v-list-item-subtitle>
                                        </v-list-item-content>
                                    </template>
                                </v-list-item>
                                <v-list-item value="solve_404_routing_bug">
                                    <template v-slot:default="{ active, toggle }">
                                        <v-list-item-action>
                                            <v-checkbox :input-value="active" color="primary" @click="toggle"/>
                                        </v-list-item-action>
                                        <v-list-item-content>
                                            <v-list-item-title>Solve 404 Routing Bug</v-list-item-title>
                                            <v-list-item-subtitle>
                                                Make the <strong>laravel web router</strong> render the application regardless of the URL &mdash; try refreshing this page.
                                            </v-list-item-subtitle>
                                        </v-list-item-content>
                                    </template>
                                </v-list-item>
                                <v-list-item value="success_error_state">
                                    <template v-slot:default="{ active, toggle }">
                                        <v-list-item-action>
                                            <v-checkbox :input-value="active" color="primary" @click="toggle"/>
                                        </v-list-item-action>
                                        <v-list-item-content>
                                            <v-list-item-title>Success &amp; Error  State</v-list-item-title>
                                            <v-list-item-subtitle>
                                                Make the <strong>user interface</strong> have success and error states for the code you've added.
                                            </v-list-item-subtitle>
                                        </v-list-item-content>
                                    </template>
                                </v-list-item>
                            </v-list-item-group>
                        </v-list>
                    </v-card-text>
                </v-card>
            </v-container>
        </template>
    </application>
</template>

<script>
export default {
    data() {
        return {
            checklist: []
        }
    },
    mounted() {
        this.checklist = JSON.parse(localStorage.getItem('checklist')) || [];
    },
    watch: {
        checklist: function (checklist) {
            localStorage.setItem('checklist', JSON.stringify(checklist));
        }
    }
}
</script>
