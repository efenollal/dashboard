<template>
    <application>
        <template v-slot:content>
            <v-container class="px-4 py-1" fluid>
                <v-row>
                    <v-col cols="12" sm="6">
                        <v-card :loading="loading">
                            <v-card-text>
                                <v-row align="center">
                                    <v-col cols="8">
                                        <div class="headline mb-2">Active Domains</div>
                                        Total number of currently active domains.
                                    </v-col>
                                    <v-col class="display-3 text-center" cols="4">
                                        {{ stats.active }}
                                    </v-col>
                                </v-row>
                            </v-card-text>
                        </v-card>
                    </v-col>
                    <v-col cols="12" sm="6">
                        <v-card :loading="loading">
                            <v-card-text>
                                <v-row align="center">
                                    <v-col cols="8">
                                        <div class="headline mb-2">Trashed Domains</div>
                                        Total number of domains in the trash.
                                    </v-col>
                                    <v-col class="display-3 text-center" cols="4">
                                        {{ stats.trash }}
                                    </v-col>
                                </v-row>
                            </v-card-text>
                        </v-card>
                    </v-col>
                    <v-col cols="12" sm="6">
                        <v-card :loading="loading">
                            <v-card-text>
                                <v-row align="center">
                                    <v-col cols="8">
                                        <div class="headline mb-2">Internationalized Domains</div>
                                        Total number of internationalized domains.
                                    </v-col>
                                    <v-col class="display-3 text-center" cols="4">
                                        {{ stats.internationalized }}
                                    </v-col>
                                </v-row>
                            </v-card-text>
                        </v-card>
                    </v-col>
                    <v-col cols="12" sm="6">
                        <v-card :loading="loading">
                            <v-card-text>
                                <v-row align="center">
                                    <v-col cols="8">
                                        <div class="headline mb-2">Imprinted Domains</div>
                                        Total number of imprinted domains.
                                    </v-col>
                                    <v-col class="display-3 text-center" cols="4">
                                        {{ stats.imprinted }}
                                    </v-col>
                                </v-row>
                            </v-card-text>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
        </template>
    </application>
</template>

<script>
    import axios from 'axios';

  export default {
    data () {
        return {
            loading: false,
            stats: {
                active: 0,
                trash: 0,
                internationalized: 0,
                imprinted: 0
            }
        }
    },
    mounted() {
        this.fetchStats();
    },
    methods: {
        async fetchStats() {
            try {
                this.loading = true;
                const stats = await axios.get('/api/dashboard/stats');
                this.stats = stats.data;
            }
            catch (e) {
                console.log(e);
            }
            finally {
                this.loading = false;
            }
        }
    }
  }
</script>
