import { ApiServiceProvider } from './ApiServiceProvider';

declare global {
    export interface StreamsGlobalApi {
        ApiServiceProvider: typeof ApiServiceProvider
    }

    export interface StreamsGlobal {
        api: StreamsGlobalApi
    }
}
