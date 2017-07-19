namespace php service.x

include "base.thrift"

struct xReq
{
    1: base.baseReqHeader header;
    2: string name;

}

struct xResp
{
    1:base.baseRespHeader header;
	2:i32 age;
}
