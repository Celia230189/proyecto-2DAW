# Instrucciones para desplegar en Railway

## Método 1: Importar variables automáticamente

1. En Railway, ve a tu proyecto Laravel
2. Click en "Variables" en el menú lateral
3. Click en "RAW Editor" (arriba a la derecha)
4. Copia TODO el contenido del archivo `.env.railway` y pégalo ahí
5. Click en "Deploy"

## Método 2: Usar Railway CLI (más rápido)

```bash
# Instalar Railway CLI
npm i -g @railway/cli

# Iniciar sesión
railway login

# Conectar al proyecto (selecciona tu proyecto cuando te lo pida)
railway link

# Subir las variables de entorno
railway variables --set-from-file .env.railway

# Ver el estado del despliegue
railway status
```

## Importante:

Railway auto-detectará las siguientes variables si añades MySQL como servicio:
- ${MYSQL_HOST}
- ${MYSQL_PORT}
- ${MYSQL_DATABASE}
- ${MYSQL_USER}
- ${MYSQL_PASSWORD}

Y también:
- ${RAILWAY_PUBLIC_DOMAIN} - Se genera automáticamente cuando despliega

## Para añadir MySQL:
1. En tu proyecto Railway, click "+ New"
2. Selecciona "Database"
3. Selecciona "Add MySQL"
4. Railway creará automáticamente las variables de conexión

## Tu APP_KEY ya está generada:
`base64:kuMNm17eRpnLvZEL0nvHNhqCjuggYEkpHKVdEygNPws=`

Esta clave es única y segura para tu aplicación.
