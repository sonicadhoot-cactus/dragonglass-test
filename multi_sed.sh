export base_env=$1
export envname=$2
sed -i "s/DB_HOST=.*/DB_HOST=db.crm-"$base_env".rw.cactusops.com/g" /var/www/"$envname"/dragonglass/*/.env ;
sed -i "s/S3_BUCKET_NAME=.*/S3_BUCKET_NAME="$base_env"-whiteboard-client-files/g" /var/www/"$envname"/dragonglass/*/.env ;
sed -i "s/S3_HOST_NAME=.*/S3_HOST_NAME="$base_env"-whiteboard-client-files.s3.amazonaws.com/g" /var/www/"$envname"/dragonglass/*/.env ;
sed -i "s/REVISIONS_DB_HOST=.*/REVISIONS_DB_HOST=db.crm-"$base_env".rw.cactusops.com/g" /var/www/"$envname"/dragonglass/*/.env ;
sed -i "s/APP_PREFIX=.*/APP_PREFIX="$envname"/g" /var/www/"$envname"/dragonglass/idp/.env;
sed -i "s|APP_URL=.*|APP_URL=https://"$envname".accounts.editage.com|g" /var/www/"$envname"/dragonglass/idp/.env ;
sed -i "s/DB_HOST=.*/DB_HOST=db.crm-"$base_env".rw.cactusops.com/g" /var/www/"$envname"/dragonglass/idp/.env ;
sed -i "s/S3_BUCKET_NAME=.*/S3_BUCKET_NAME="$base_env"-whiteboard-client-files/g" /var/www/"$envname"/dragonglass/idp/.env ;
sed -i "s/APP_PREFIX=.*/APP_PREFIX="$envname"/g" /var/www/"$envname"/dragonglass/partner/.env;
sed -i "s|APP_URL=.*|APP_URL=https://"$envname".accounts.editage.com|g" /var/www/"$envname"/dragonglass/partner/.env ;
sed -i "s/DB_HOST=.*/DB_HOST=db.crm-"$base_env".rw.cactusops.com/g" /var/www/"$envname"/dragonglass/partner/.env ;
sed -i "s/S3_BUCKET_NAME=.*/S3_BUCKET_NAME="$base_env"-whiteboard-client-files/g" /var/www/"$envname"/dragonglass/partner/.env ;
sed -i "s/PAGE_DB_HOST=.*/PAGE_DB_HOST=nv-db-cmswebsite-rw-dev-back.cmv0jyly8cc5.us-east-1.rds.amazonaws.com/g" /var/www/"$envname"/dragonglass/*/.env ;
