import { usePage } from '@inertiajs/vue3';
import { ref, computed, watch } from 'vue';

type Notification = {
    title: string;
    message: string;
    type: 'success' | 'failure';
};

export let useNotification = () => {
    let page = usePage();

    let show = ref(false);

    // prettier-ignore
    let notification = computed(() => {
        return Object.keys(page.props.errors).length > 0 ? {
            title: `There where ${Object.keys(page.props.errors).length} errors with your submission.`,
            message: 'Please review and try again.',
            type: 'failure'
        } : page.props.notification as Notification | undefined;
    });

    watch(
        () => notification.value,
        (notification) => {
            if (notification) {
                show.value = true;

                setTimeout(() => {
                    show.value = false;
                }, 3000);
            }
        },
        {
            immediate: true,
        }
    );

    let hide = () => {
        show.value = false;
    };

    return {
        show,
        data: notification,
        hide,
    };
};
