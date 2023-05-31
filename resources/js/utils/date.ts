import d from 'dayjs';
import advancedFormat from 'dayjs/plugin/advancedFormat';
import relativeTime from 'dayjs/plugin/relativeTime';
import timezone from 'dayjs/plugin/timezone';
import utc from 'dayjs/plugin/utc';

d.extend(advancedFormat);
d.extend(relativeTime);
d.extend(timezone);
d.extend(utc);

export default d;
