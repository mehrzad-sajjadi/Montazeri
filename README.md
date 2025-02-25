# **سیستم مدیریت کارآموزی دانشجویان**

## **مقدمه**
با وجود مهارت‌های فراوان دانشجویان، متأسفانه پلتفرمی مناسب برای اتصال آن‌ها به بازار کار وجود ندارد. این پروژه با هدف رفع این مشکل طراحی شده است تا:
- دانشجویان بتوانند به راحتی محل مناسبی برای کارآموزی پیدا کنند.
- استادان بتوانند نظارت دقیقی بر عملکرد دانشجویان خود داشته باشند و از حضور موثر آن‌ها در محل کارآموزی مطمئن شوند.
- هیئت علمی دانشگاه از صحت عملکرد استادان و پیشرفت دانشجویان اطمینان حاصل کند.
- شرکت‌ها بتوانند به راحتی کارآموزان موردنظر خود را جذب کنند.

این نرم‌افزار با استفاده از **Laravel** و **Vue.js** توسعه داده شده و تمام این نیازها را برطرف می‌کند.

---

## **ویژگی‌های کلیدی پروژه**
1. **مدیریت گزارشات روزانه دانشجویان**  
   دانشجویان می‌توانند:
   - محل کارآموزی خود را ثبت کنند.
   - گزارشات روزانه شامل تاریخ، ساعت ورود و خروج، و فایل‌های تصویری یا ویدیویی ثبت کنند.

2. **نظارت استادان بر دانشجویان**  
   استادان می‌توانند:
   - لیست دانشجویانی که آن‌ها را انتخاب کرده‌اند مشاهده کنند.
   - گزارشات روزانه دانشجویان را بررسی و در صورت نیاز دانلود کنند.

3. **نظارت هیئت علمی دانشگاه**  
   اعضای هیئت علمی می‌توانند:
   - گزارشات دانشجویان خود را بررسی کنند.
   - به گزارشات سایر دانشجویان برای نظارت بر عملکرد استادان دسترسی داشته باشند.

4. **ایجاد آگهی توسط شرکت‌ها**  
   شرکت‌ها می‌توانند:
   - آگهی جذب کارآموز ایجاد کنند.
   - آگهی‌ها برای تمامی کاربران (دانشجویان و استادان) قابل مشاهده خواهد بود.

---

## **ساختار کلی نرم‌افزار**
### **گروه‌های کاربری**
نرم‌افزار به چهار گروه اصلی تقسیم شده است:
1. **دانشجویان**  
   - ثبت محل کارآموزی، انتخاب استاد، و ارسال گزارشات.
2. **استادان**  
   - مشاهده لیست دانشجویان و بررسی گزارشات.
3. **هیئت علمی دانشگاه**  
   - مشاهده و نظارت بر گزارشات تمام دانشجویان و عملکرد استادان.
4. **شرکت‌ها**  
   - ثبت آگهی جذب کارآموز.

### **ویژگی‌های فنی**
- **فریمورک بک‌اند:** Laravel  
- **فریمورک فرانت‌اند:** Vue.js  
- **معماری نرم‌افزار:** دسترسی‌های جداگانه برای گروه‌های کاربری با تمرکز بر امنیت و دسترسی‌پذیری.

---

## **نحوه استفاده**
1. **دانشجویان:**  
   - ثبت‌نام و تکمیل اطلاعات کارآموزی.
   - ثبت گزارشات روزانه.
   - مشاهده آگهی‌های شرکت‌ها.

2. **استادان:**  
   - مشاهده لیست دانشجویان و بررسی گزارشات.

3. **هیئت علمی:**  
   - مشاهده وضعیت کلی دانشجویان و بررسی عملکرد استادان.

4. **شرکت‌ها:**  
   - ثبت آگهی جذب کارآموز و مشاهده درخواستهای کارآموزی از سوی دانشجویان.

---

## **چشم‌انداز پروژه**
این نرم‌افزار با هدف تسهیل ارتباط بین دانشجویان، استادان، دانشگاه‌ها، و شرکت‌ها طراحی شده است و تلاش دارد:
- دسترسی دانشجویان به فرصت‌های کارآموزی را افزایش دهد.
- نظارت استادان و هیئت علمی را بهبود بخشد.
- شرکت‌ها را در جذب نیروی مستعد یاری کند.
