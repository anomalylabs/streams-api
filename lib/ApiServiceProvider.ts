import { ServiceProvider } from '@laravel-streams/core';
import Axios               from 'axios';

export class ApiServiceProvider extends ServiceProvider {

    public register() {
        this.app.dynamic('api', () => {
            return Axios.create({

            })
        })
    }
}
