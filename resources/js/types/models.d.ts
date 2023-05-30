/**
 * This file is auto generated using 'php artisan typescript:generate'
 *
 * Changes to this file will be lost when the command is run again
 */

declare namespace App.Models {
    export interface Event {
        id: number;
        user_id: number;
        title: string;
        description: string | null;
        start_date: string;
        start_time: string;
        end_date: string;
        end_time: string;
        price: number;
        seats: number;
        times: Array<any> | any | null;
        created_at: string | null;
        updated_at: string | null;
        organizer?: App.Models.User | null;
    }

    export interface User {
        id: number;
        name: string;
        email: string;
        email_verified_at: string | null;
        password: string;
        remember_token: string | null;
        created_at: string | null;
        updated_at: string | null;
        events?: Array<App.Models.Event> | null;
        events_count?: number | null;
    }

}
